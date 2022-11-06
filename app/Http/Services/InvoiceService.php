<?php

namespace  App\Http\Services;


use App\Jobs\ProcessPodcast;
use App\Models\Product;

class InvoiceService {
    private $products, $details, $productsDetails;
    public function __construct($order)
    {
        $this->products = $order['products'];
        $this->details = $order;
    }

    public function constructInvoice(){
        $fullData = [];
        $total = 0;
        foreach ($this->products as $product){
            $fullData[$product["product_id"]] =
                [
                    "details" => Product::with('ingredients')->find($product["product_id"]),
                    "quantity" => $product['quantity']
                ];
            $total +=$product['quantity'] * $fullData[$product["product_id"]]['details']->price;
        }
        $this->productsDetails = $fullData;
        $vat = $total * config('defines.VAT_KSA');
        $total += $vat;
        return  [
            "products" => $fullData,
            "total" => $total,
            'vat' => $vat,
            'customer_name' => $this->details['customer_name'] ?? '',
            'customer_phone' => $this->details['customer_phone'] ?? '',
            'address' => $this->details['address'] ?? '',
            'delivery_fees' => 0
        ];
    }

    public function updateIngredients(){
        foreach ($this->productsDetails as $key => $product){
            foreach ($product['details']->ingredients as $keyIn => $ingredient){
                foreach ($ingredient->ingredient as $item){
                    $item->quantity -= ($ingredient->quanity * $product['quantity']);
                    if($item->quantity/$item->base_quantity <= config('defines.EMAIL_SEND_PERCENTAGE')){
                        ProcessPodcast::dispatch($item);
                    }
                    if($item->quantity < 0) return true;

                   $item->save();
                }
            }
        }

        return false;
    }
}

<?php

namespace App\Repositories;

use App\Http\Services\InvoiceService;
use App\Models\Orders;

class OrdersRepository {
    private $model;
    public function __construct()
    {
        $this->model = (new Orders);
    }

    public function createOrder($order){

        $invoice = (new InvoiceService($order));
        if($temp = $invoice->constructInvoice()) {
            abort_if($invoice->updateIngredients(), 406, 'OUT_OFF_STOCK');
            Orders::add($temp);
        }

        return response()->json($invoice, 200);
    }
}

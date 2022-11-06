<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $casts = [
        'products' => 'json'
    ];

    protected $fillable = [
        "customer_name",
        "customer_phone",
        "price",
        "vat",
        "products",
        "address",
        "delivery_fees"
    ];

    public static function add($order){
        Orders::create([
            'customer_name' => $order['customer_name'],
            'customer_phone' => $order['customer_phone'],
            'price' => $order['total'],
            'vat' => $order['vat'],
            'products' => $order['products'],
            'address' => $order['address'],
            'delivery_fees' => $order['delivery_fees']
        ]);
    }
}

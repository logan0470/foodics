<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Repositories\OrdersRepository;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    private $repo;
    public function __construct(OrdersRepository $ordersRepository)
    {
        $this->repo = $ordersRepository;
    }

    public function create(RegisterRequest $request) {
        return $this->repo->createOrder($request);
    }
}

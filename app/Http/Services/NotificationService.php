<?php


namespace App\Http\Services;

use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;

class NotificationService {

    private $ingredient;

    public function __construct($ingredient)
    {
        $this->ingredient = $ingredient;
    }

    public function sendEmail(){

        try {
            Mail::to(config('defines.owner_email'))->send(new OrderShipped($this->ingredient));
        }catch(\Exception $ex){}
    }
}

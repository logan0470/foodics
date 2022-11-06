<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\NewAccessToken;
use Illuminate\Support\Facades\Auth;
use \App\Http\Controllers\OrdersController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/tokens/create', function (Request $request) {

    $user = (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember));
    if($user) {
        $token = Auth::user()->createToken($request->token_name);
    }else {
        return response()->json('Not Found', 404);
    }
    return ['token' => $token->plainTextToken];
});

Route::middleware('auth:sanctum')->prefix('orders')->group(function (){
    Route::post('/create', [OrdersController::class, 'create']);
});

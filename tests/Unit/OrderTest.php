<?php

namespace Tests\Unit;

use App\Models\ProductsIngredient;
use App\Models\User;
use Tests\TestCase;

class OrderTest extends TestCase
{

    /** @test
     * A basic unit test example.
     *
     * @return void
     */
    function create_success_order()
    {

        $user = User::factory()->create();

        $response = $this->post('api/tokens/create', ['email' => $user->email, 'password' => 'password', 'token_name' => '*']);
        $response->assertStatus(200);

        \App\Models\Product::factory(3)->create();
        \App\Models\Ingredient::factory(5)->create();
        \App\Models\ProductsIngredient::factory(5)->create();

        $product = ProductsIngredient::first();

        $response2 = $this->withHeaders(['Authorization'=>'Bearer '.$response->json()['token']])
            ->post('api/orders/create', ['customer_name' => 'fake',
                'customer_phone' => '+962786672470',
                'address' => 'riyadh',
                'products' => [
                    [
                        'product_id' => $product->id,
                        'quantity' => 1
                    ]
                ]]);

        $response2->assertStatus(200);

    }


    /** @test
     * A basic unit test example.
     *
     * @return void
     */
    function create_failed_order()
    {

        $user = User::factory()->create();

        $response = $this->post('api/tokens/create', ['email' => $user->email, 'password' => 'password', 'token_name' => '*']);
        $response->assertStatus(200);

        \App\Models\Product::factory(3)->create();
        \App\Models\Ingredient::factory(5)->create();
        \App\Models\ProductsIngredient::factory(5)->create();

        $product = ProductsIngredient::first();

        $response2 = $this->withHeaders(['Authorization'=>'Bearer '.$response->json()['token']])
            ->post('api/orders/create', ['customer_name' => 'fake',
                'address' => 'riyadh',
                'products' => [
                    [
                        'product_id' => $product->id,
                        'quantity' => 1
                    ]
                ]]);

        $response2->assertStatus(422);

    }


    /** @test
     * A basic unit test example.
     *
     * @return void
     */
    function create_success_order_with_send_email()
    {

        $user = User::factory()->create();

        $response = $this->post('api/tokens/create', ['email' => $user->email, 'password' => 'password', 'token_name' => '*']);
        $response->assertStatus(200);

        \App\Models\Product::factory(3)->create();
        \App\Models\Ingredient::factory(5)->create();
        \App\Models\ProductsIngredient::factory(5)->create();

        $product = ProductsIngredient::first();

        $response2 = $this->withHeaders(['Authorization'=>'Bearer '.$response->json()['token']])
            ->post('api/orders/create', [
                'customer_name' => 'fake',
                'customer_phone' => '+962786672470',
                'address' => 'riyadh',
                'products' => [
                    [
                        'product_id' => $product->id,
                        'quantity' => 500
                    ]
                ]]);

        $response2->assertStatus(200);

    }

}

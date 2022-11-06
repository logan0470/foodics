<?php

namespace Tests\Unit;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserTest extends TestCase
{
    /** @test
     * A basic functional test example.
     *
     * @return void
     */
    function login_user(){

        $user = User::factory()->create();

        $response = $this->post('api/tokens/create', ['email' => $user->email, 'password' => 'password', 'token_name' => '*']);
        $response->assertStatus(200);
    }



    /** @test
     * A basic functional test example.
     *
     * @return void
     */
    function login_user_failed(){
        $user = User::factory()->create();

        $response = $this->post('api/tokens/create', ['email' => $user->email, 'password' => 'password-wrong', 'token_name' => '*']);
        $response->assertStatus(404);
    }


}

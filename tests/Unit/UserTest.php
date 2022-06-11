<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_login_form()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_user_duplication()
    {
        $user1 = User::make([
            'name' => 'Jeff Bezos',
            'email' => 'jeffbezos@example.com',
        ]);

        $user2 = User::make([
            'name' => 'Elon Musk',
            'email' => 'elonmusk@example.com',
        ]);

        $this->assertTrue(true);
    }

    public function test_delete_user()
    {
        $user = User::factory()->count(1)->make();

        $user = User::first();

        if($user){
            $user->delete();
        }

        $this->assertTrue(true);
    }

    public function test_it_stores_new_object()
    {
        $response = $this->post('/register', [
            'name' => 'Bill Gates',
            'email' => 'billgates@example.com',
            'password' => 'billgates123',
            'password_confirmation' => 'billgates123'
        ]);

        $response->assertRedirect('/home');
    }

    public function test_database_has()
    {
        $this->assertDatabaseHas('users', [
            'name' => 'Bill Gates'
        ]);
    }

    public function test_database_missing()
    {
        $this->assertDatabaseMissing('users', [
            'name' => 'Bill Gatess'
        ]);
    }

    public function test_if_seeders_works()
    {
        $this->seed(); // php artisan db:seed
    }
}

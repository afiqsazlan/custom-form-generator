<?php

namespace Tests\Feature\Api\V1;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{

    public function test_user_can_register(): void
    {
        $userData = [
            'name' => 'Ali',
            'email' => 'ali@example.com',
            'password' => 'test1234',
            'password_confirmation' => 'test1234'
        ];

        $response = $this->postJson('api/v1/register', $userData);
        $response->assertStatus(200);

        // Assert user is created
        $this->assertDatabaseHas('users', ['email' => $userData['email']]);

        // Assert user has token
        $user = User::where('email', $userData['email'])->first();
        $this->assertNotNull($user);
        $this->assertNotEmpty($user->tokens);

        // Assert token is returned on success
        $response->assertJsonStructure(['token']);
    }
}

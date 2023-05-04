<?php

namespace Tests\Feature\Api\V1;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login(): void
    {
        $this->withoutExceptionHandling();

        // Create test user
        User::factory()->state([
            'email' => 'test@example.com',
            'password' => Hash::make('test1234')
        ])->create();

        // Make a GET request to the /sanctum/csrf-cookie endpoint to set the CSRF token
        $response = $this->postJson("api/v1/login", [
            'email' => 'test@example.com',
            'password' => 'test1234'
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure(['token']);
    }

    public function test_user_cannot_login_with_invalid_credentials()
    {
        $response = $this->postJson("api/v1/login", [
            'email' => 'fake@example.com',
            'password' => 'fake1234'
        ]);
        $response->assertStatus(422);
        $this->assertGuest();
        $response->assertJsonStructure(['message']);
    }
}

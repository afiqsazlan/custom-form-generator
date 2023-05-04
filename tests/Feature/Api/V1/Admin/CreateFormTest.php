<?php

namespace Tests\Feature\Api\V1\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CreateFormTest extends TestCase
{

    use RefreshDatabase;

    public function test_user_can_create_form(): void
    {

        // Create test user
        $user = User::factory()->create();

        $this->withoutExceptionHandling();

        $payload = [
            'title' => 'Test Form',
            'inputs' => [
                [
                    'type' => 'text',
                    'label' => 'name'
                ]
            ]
        ];

        $response = $this->actingAs($user)
            ->postJson('api/v1/admin/forms/create', $payload);

        $response->assertStatus(200);

        $this->assertDatabaseHas('forms', [
            'title' => 'Test Form'
        ]);
    }

    public function test_form_inputs_require_type_attribute()
    {
        // Create test user
        $user = User::factory()->create();

        $payload = [
            'title' => 'Test Form',
            'inputs' => [
                [
                    'label' => 'Name'
                ],
                [
                    'type' => 'text',
                    'label' => 'Email'
                ]
            ]
        ];

        $response = $this->actingAs($user)
            ->postJson('api/v1/admin/forms/create', $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['inputs.0.type']);
    }

    public function test_form_requires_at_least_one_input()
    {
        // Create test user
        $user = User::factory()->create();

        $payload = [
            'title' => 'Test Form',
            'inputs' => []
        ];

        $response = $this->actingAs($user)
            ->postJson('api/v1/admin/forms/create', $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['inputs']);
    }


    public function test_form_title_is_required()
    {
        // Create test user
        $user = User::factory()->create();

        $payload = [
            'inputs' => [
                [
                    'type' => 'text',
                    'label' => 'Name'
                ]
            ]
        ];

        $response = $this->actingAs($user)
            ->postJson('api/v1/admin/forms/create', $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['title']);
    }

}

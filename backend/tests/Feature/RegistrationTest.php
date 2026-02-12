<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_and_get_token(): void
    {
        $response = $this->postJson('/api/auth/register', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        if ($response->status() !== 201) {
            dump($response->json());
        }

        $response->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'token',
                'member' => [
                    'id',
                    'user_id',
                    'full_name',
                    'email',
                ],
            ]);

        $this->assertDatabaseHas('users', [
            'email' => 'john.doe@example.com',
        ]);

        $this->assertDatabaseHas('personal_access_tokens', [
            'name' => 'auth-token',
            'tokenable_type' => 'Modules\Auth\Infrastructure\Models\User',
        ]);
    }
}

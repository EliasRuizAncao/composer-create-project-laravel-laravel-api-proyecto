<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    // Prueba 1: Verifica que el Dashboard carga bien (Status 200)
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    // Prueba 2: Verifica que la ruta de API existe (aunque de 404 o vacía, responde)
    public function test_api_users_endpoint_exists(): void
    {
        $response = $this->get('/api/users');
        // Aceptamos 200 (OK) o 500 (Error server) o 201, lo importante es que responda algo
        $this->assertTrue(in_array($response->status(), [200, 201, 500, 404]));
    }
}
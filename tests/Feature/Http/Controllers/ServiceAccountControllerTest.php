<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ServiceAccountController
 */
class ServiceAccountControllerTest extends TestCase
{

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /**
     * @test
     */
    public function index_displays_view()
    {
        $response = $this->actingAs($this->user)->get(route('ui.service-accounts.index'));

        $response->assertOk();
        $response->assertViewIs('service_account.index');
    }
}

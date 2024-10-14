<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MiddlewareTest extends TestCase
{
    /** @group middleware */
    public function test_the_middleware_injects_the_header_to_allow_access()
    {
        $this->get('/stuck-in-the-middle')
            ->assertSuccessful();
    }
}

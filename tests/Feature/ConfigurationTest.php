<?php

namespace Tests\Feature;

use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigurationTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /** @group config */
    public function test_the_config_value_is_used_when_the_per_page_query_param_is_missing()
    {
        Movie::factory(20)->create();

        config(['movies.per_page' => 3]);

        $response = $this->getJson('/api/movies');

        $response->assertJsonFragment(['total' => 20]);
        $response->assertJsonCount(3, 'data');
    }

    /** @group config */
    public function test_the_config_helper_also_has_a_fallback_value_if_the_config_key_is_missing()
    {
        Movie::factory(20)->create();

        config(['movies.per_page' => null]);

        $response = $this->getJson('/api/movies');

        $response->assertJsonFragment(['total' => 20]);
        $response->assertJsonCount(15, 'data');
    }
}

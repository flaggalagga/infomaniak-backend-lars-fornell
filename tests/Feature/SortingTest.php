<?php

namespace Tests\Feature;

use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SortingTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @group sorting
     * @group bonus
     */
    public function test_the_movies_are_sorted_according_to_the_query_parameters()
    {
        Movie::factory()->create(['title' => 'A']);
        Movie::factory()->create(['title' => 'B']);

        $this->getJson('/api/movies?sort=title&dir=desc')
            ->assertJsonPath('data.0.title', 'B')
            ->assertJsonPath('data.1.title', 'A');
    }
}

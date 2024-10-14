<?php

namespace Tests\Feature\Api;

use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MoviesApiTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /**
     * @group api
     * @group api:list
     */
    public function test_it_returns_the_list_of_movies()
    {
        $movies = Movie::factory(5)->create();

        $response = $this->getJson("/api/movies");

        $response->assertJsonFragment(['data' => $movies->toArray()]);
    }

    /**
     * @group api
     * @group api:filter
     */
    public function test_it_filters_the_list_of_movies_by_name()
    {
        // Create 5 movies that we should never find
        Movie::factory(5)->create([
            'title' => 'movie' . $this->faker->numerify('##')
        ]);

        // Create two movies that we should always find
        $toFind = Movie::factory(2)->create([
            'title' => 'find_me' . $this->faker->numerify('##')
        ]);

        $response = $this->getJson('/api/movies?search=find_me');

        $response->assertJsonCount(2, 'data');
        $response->assertJsonFragment(['data' => $toFind->toArray()]);
    }

    /**
     * @group api
     * @group api:pagination
     */
    public function test_it_returns_a_paginated_response_of_movies_with_a_default_per_page_number()
    {
        Movie::factory(20)->create();

        $response = $this->getJson('/api/movies');

        $response->assertJsonFragment(['total' => 20]);

        $response->assertJsonCount(10, 'data');
    }

    /**
     * @group config
     */
    public function test_it_returns_a_paginated_response_of_movies_with_a_default_per_page_number_retrieved_from_config()
    {
        Movie::factory(20)->create();

        config(['movies.per_page' => 7]);

        $response = $this->getJson('/api/movies');

        $response->assertJsonFragment(['total' => 20]);

        $response->assertJsonCount(7, 'data');
    }

    /**
     * @group api
     * @group api:pagination
     */
    public function test_it_returns_a_paginated_response_of_movies_with_a_custom_per_page_number()
    {
        Movie::factory(20)->create();

        $response = $this->getJson('/api/movies?perPage=5');

        $response->assertJsonFragment(['total' => 20]);
        $response->assertJsonCount(5, 'data');
    }

    /**
     * @group api
     * @group api:show
     */
    public function test_it_returns_the_details_of_a_movie()
    {
        $movie = Movie::factory()->create();

        $response = $this->getJson("/api/movies/{$movie->id}");

        $response->assertExactJson(['data' => $movie->toArray()]);
    }

    /**
     * @group api
     * @group api:create
     */
    public function test_it_inserts_a_movie_in_the_database()
    {
        $movie = Movie::factory()->make()
            ->only(['title', 'year', 'poster']);

        $this->postJson('/api/movies', $movie);

        $this->assertDatabaseCount('movies', 1);
        $this->assertDatabaseHas('movies', $movie);
    }

    /**
     * @group api
     * @group api:update
     */
    public function test_it_updates_a_movie_in_the_database()
    {
        $originalMovie = Movie::factory()->create();
        $this->assertDatabaseHas('movies', ['title' => $originalMovie->title]);

        $this->patchJson("/api/movies/{$originalMovie->id}", [
            'title' => $newTitle = $originalMovie->title . ' updated'
        ]);

        $this->assertDatabaseCount('movies', 1);
        $this->assertDatabaseHas('movies', ['title' => $newTitle]);
    }

    /**
     * @group api
     * @group api:update
     */
    public function test_it_removes_the_poster_if_null_is_given()
    {
        $movie = Movie::factory()->create();

        $this->patchJson("/api/movies/{$movie->id}", [
            'poster' => null,
        ]);

        $this->assertDatabaseHas('movies', [
            'title' => $movie->title,
            'year' => $movie->year,
            'poster' => null,
        ]);
    }

    /**
     * @group api
     * @group api:validate
     * @group bonus
     */
    public function test_it_doesnt_add_a_movie_if_wrong_parameter()
    {
        $response = $this->postJson('/api/movies', [
            'title' => 123456,
            'year' => 'year',
            'poster' => 987654
        ]);

        $response->assertJsonValidationErrors(['title', 'year', 'poster']);
        $response->assertStatus(422);
        $this->assertDatabaseCount('movies', 0);
    }

    /**
     * @group api
     * @group api:validate
     * @group bonus
     */
    public function test_it_doesnt_update_a_movie_if_wrong_parameter()
    {
        $movie = Movie::factory()->create();
        $this->assertDatabaseHas('movies', [
            'title'  => $movie->title,
            'year'   => $movie->year,
            'poster' => $movie->poster
        ]);

        $response = $this->patchJson("/api/movies/{$movie->id}", [
            'title' => 123456,
            'year' => 'year',
            'poster' => 987654
        ]);

        $response->assertJsonValidationErrors(['title', 'year', 'poster']);
        $response->assertStatus(422);
        $this->assertDatabaseCount('movies', 1);
        $this->assertDatabaseHas('movies', [
            'title'  => $movie->title,
            'year'   => $movie->year,
            'poster' => $movie->poster
        ]);
    }

    /**
     * @group api
     * @group api:delete
     */
    public function test_it_deletes_a_movie_from_the_database()
    {
        $movie = Movie::factory()->create();
        $this->assertDatabaseCount('movies', 1);

        $this->deleteJson("/api/movies/{$movie->id}")
            ->assertSuccessful();

        $this->assertDatabaseCount('movies', 0);
    }
}

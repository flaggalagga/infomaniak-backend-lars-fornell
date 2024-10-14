<?php

namespace Tests\Feature\Api;

use App\Models\Movie;
use App\Models\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReviewsApiTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /**
     * @group review
     * @group review:list
     * @group bonus
     */
    public function test_it_returns_the_list_of_reviews()
    {
        $movie = Movie::factory()->create();

        $reviews = Review::factory(5)->make()->only(['author', 'body']);
        $movie->reviews()->createMany($reviews);

        $response = $this->getJson('/api/movies/' . $movie->id . '/reviews');

        $response->assertJsonFragment(['data' => $reviews->toArray()]);
    }


    /**
     * @group review
     * @group review:list
     * @group bonus
     */
    public function test_it_returns_a_paginated_response_of_reviews_with_a_default_per_page_number()
    {
        $movie = Movie::factory()->has(Review::factory()->count(25))->create();

        $response = $this->getJson('/api/movies/' . $movie->id . '/reviews');

        $response->assertJsonFragment(['total' => 25]);

        $response->assertJsonCount(5, 'data');
    }


    /**
     * @group review
     * @group review:list
     * @group bonus
     */
    public function test_it_returns_a_paginated_response_of_movies_with_a_default_per_page_number_retrieved_from_config()
    {
        $movie = Movie::factory()->has(Review::factory()->count(25))->create();

        config(['reviews.per_page' => 7]);

        $response = $this->getJson('/api/movies/' . $movie->id . '/reviews');

        $response->assertJsonFragment(['total' => 25]);

        $response->assertJsonCount(7, 'data');
    }

    /**
     * @group review
     * @group review:list
     * @group bonus
     */
    public function test_it_returns_a_paginated_response_of_reviews_with_a_custom_per_page_number()
    {
        $movie = Movie::factory()->has(Review::factory()->count(25))->create();

        $response = $this->getJson('/api/movies/' . $movie->id . '/reviews?perPage=10');

        $response->assertJsonFragment(['total' => 25]);
        $response->assertJsonCount(10, 'data');
    }



    /**
     * @group review
     * @group review:create
     * @group bonus
     */
    public function test_it_inserts_a_review_in_the_database()
    {
        $movie = Movie::factory()->create();
        $review = Review::factory()->make()->only(['author', 'body']);

        $this->postJson('/api/movies/' . $movie->id . '/reviews', $review);

        $this->assertDatabaseCount('reviews', 1);
        $this->assertDatabaseHas('reviews', $review);
    }

    /**
     * @group review
     * @group review:create
     * @group bonus
     */
    public function test_it_doesnt_add_a_review_if_wrong_parameter()
    {
        $movie = Movie::factory()->create();
        $response = $this->postJson('/api/movies/' . $movie->id . '/reviews', [
            'author' => 123456,
            'body' => null
        ]);

        $response->assertJsonValidationErrors(['author', 'body']);
        $response->assertStatus(422);
        $this->assertDatabaseCount('reviews', 0);
    }


    /**
     * @group review
     * @group review:update
     * @group bonus
     */
    public function test_it_updates_a_review_in_the_database()
    {
        $movie = Movie::factory()->create();
        $originalReview = $movie->reviews()->create(Review::factory()->make()->only(['author', 'body']));
        $this->assertDatabaseHas('reviews', [
            'movie_id' => $movie->id,
            'author'   => $originalReview->author
        ]);

        $this->patchJson('/api/reviews/' . $originalReview->id, [
            'author' => $newAuthor = $originalReview->author . ' updated'
        ]);

        $this->assertDatabaseCount('reviews', 1);
        $this->assertDatabaseHas('reviews', [
            'movie_id' => $movie->id,
            'author' => $newAuthor
        ]);
    }

    /**
     * @group review
     * @group review:update
     * @group bonus
     */
    public function test_it_doesnt_update_a_review_if_wrong_parameter()
    {
        $movie = Movie::factory()->create();
        $review = $movie->reviews()->create(Review::factory()->make()->only(['author', 'body']));
        $this->assertDatabaseHas('reviews', [
            'author' => $review->author,
            'body'   => $review->body
        ]);

        $response = $this->patchJson('/api/reviews/' . $review->id, [
            'author' => 123456,
            'body' => null
        ]);

        $response->assertJsonValidationErrors(['author', 'body']);
        $response->assertStatus(422);
        $this->assertDatabaseCount('reviews', 1);
        $this->assertDatabaseHas('reviews', [
            'author' => $review->author,
            'body'   => $review->body
        ]);
    }

    /**
     * @group review
     * @group review:delete
     * @group bonus
     */
    public function test_it_deletes_a_review_from_the_database()
    {
        $movie = Movie::factory()->create();
        $review = $movie->reviews()->create(Review::factory()->make()->only(['author', 'body']));
        $this->assertDatabaseCount('reviews', 1);

        $this->deleteJson('/api/reviews/' . $review->id)
            ->assertSuccessful();

        $this->assertDatabaseCount('reviews', 0);
    }
}

<?php

namespace Tests\Feature;

use App\Models\Movie;
use App\Models\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RelationsTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /** @group relation */
    public function test_the_method_is_set_in_both_models()
    {
        $this->assertTrue(method_exists(Movie::class, 'reviews'));
        $this->assertTrue(is_a((new Movie())->reviews(), 'Illuminate\Database\Eloquent\Relations\HasMany'));
        $this->assertTrue(method_exists(Review::class, 'movie'));
        $this->assertTrue(is_a((new Review())->movie(), 'Illuminate\Database\Eloquent\Relations\BelongsTo'));
    }

    /** @group relation */
    public function test_the_relation_does_work()
    {
        $movie = Movie::factory()->create();
        $this->assertDatabaseCount('movies', 1);
        $review = Review::factory()->make()->only(['author', 'body']);
        $reviewObject = $movie->reviews()->create($review);
        $this->assertDatabaseCount('reviews', 1);
        $this->assertDatabaseHas('reviews', [
            'author' => $review['author'],
            'body' => $review['body'],
            'movie_id' => $movie['id']
        ]);
        $this->assertEquals($reviewObject->movie->id, $movie->id);
    }
}

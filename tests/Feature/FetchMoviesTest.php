<?php

namespace Tests\Feature;

use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class FetchMoviesTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /** @group populate */
    public function test_the_console_command_exists()
    {
        $command = app_path('Console/Commands/FetchMovies.php');

        $this->assertFileExists($command);
    }

    /** @group populate */
    public function test_the_console_command_succeeds()
    {
        Http::fake();

        $command = $this->artisan('movies:fetch');

        $command->assertExitCode(0);
    }

    /** @group populate */
    public function test_the_movies_are_inserted_in_the_database()
    {
        // Create three fake movies
        $movies = Movie::factory(3)->make();

        // Fake HTTP calls to the external API to return the fake movies
        Http::fake([
            'localhost:3000/api/movies' => Http::response([
                'data' => $movies,
            ])
        ]);

        // Run the fetch command
        $this->artisan('movies:fetch');

        // Ensure that exactly three movies were inserted in the database
        $this->assertDatabaseCount('movies',3);

        // Ensure that the database contains all three movies
        $movies->each(function (Movie $movie){
           $this->assertDatabaseHas('movies', $movie->toArray());
        });
    }
}

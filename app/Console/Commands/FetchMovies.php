<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Movie;

class FetchMovies extends Command
{
    protected $signature = 'movies:fetch';
    protected $description = 'Fetch movies from third-party API and insert them into the database';

    public function handle()
    {
        try {
            $response = Http::get('http://localhost:3000/api/movies');

            if ($response->successful()) {
                $data = $response->json();
                // Get movies from the 'data' key if it exists, otherwise use the whole response
                $movies = $data['data'] ?? $data;

                if (!is_array($movies) && !is_object($movies)) {
                    $this->error('Invalid response format: expected array or object, got ' . gettype($movies));
                    return 0;
                }

                foreach ($movies as $movieData) {
                    Movie::updateOrCreate(
                        ['title' => $movieData['title']],
                        [
                            'year' => $movieData['year'],
                            'poster' => $movieData['poster'],
                        ]
                    );
                }

                $this->info('Movies have been successfully fetched and saved.');
                return 1;
            }

            $this->error('Failed to fetch movies from the API.');
            return 0;
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
            return 0;
        }
    }
}
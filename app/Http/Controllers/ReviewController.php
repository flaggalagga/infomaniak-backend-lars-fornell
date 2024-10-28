<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    // Lister
    public function index(Movie $movie)
    {
        $perPage = (int) request('perPage', config('reviews.per_page'));

        $reviews = $movie->reviews()->paginate($perPage);
  
        return response()->json($reviews, 200);
    }
 
    // Ajouter
    public function store(ReviewRequest $request, Movie $movie)
    {
        $review = $movie->reviews()->create($request->validated());
        return response()->json($review, 201);
    }

    // Modifier
    public function update(ReviewRequest $request, Review $review)
    {
        $review->update($request->validated());
        return response()->json($review, 201);      
    }

    // Supprimer
    public function destroy(Review $review)
    {
        $review->delete();
        return response()->json(null, 204);
    }

}

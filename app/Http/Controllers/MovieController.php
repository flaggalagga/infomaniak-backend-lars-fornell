<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Requests\MovieRequest;
use Exception;


class MovieController extends Controller
{
    // Lister
    public function index(Request $request)
    {
        $query = Movie::query();

        // Rechercher
        if ($search = $request->input('search')) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        // Trier
        if ($request->has('sort')) {
            $sortColumn = $request->input('sort');
            $direction = $request->input('dir', 'asc');
            
            // Tri par défaut
            $direction = strtolower($direction) === 'desc' ? 'desc' : 'asc';
            
            // Liste champs autorisés
            $allowedColumns = ['title', 'year'];
            
            // Trier si autorisé
            if (in_array($sortColumn, $allowedColumns)) {
                $query->orderBy($sortColumn, $direction);
            }
        }

        $perPage = (int) $request->input('perPage', config('movies.per_page')); 

        $movies = $query->paginate($perPage);

        return response()->json($movies, 200);
    }
    
    // Montrer
    public function show(Movie $movie)
    {
        return response()->json(['data' => $movie], 200);
    }

    // Ajouter
    public function store(MovieRequest $request)
    {
        $movie = Movie::create($request->validated());
        return response()->json($movie, 201);
    }

    // Modifier
    public function update(MovieRequest $request, Movie $movie)
    {
        $movie->update($request->validated());
        return response()->json($movie, 201);
    }

    // Supprimer
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return response()->json(null, 204);
    }

}

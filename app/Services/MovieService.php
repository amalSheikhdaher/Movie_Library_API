<?php

namespace App\Services;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Requests\MovieRequest;

class MovieService {

    /**
     * Retrieve a list of movies with optional filtering, sorting, and pagination.
     * 
     * This method handles fetching movies from the database, with support for filtering by genre
     * and director, sorting by release year, and paginating the results.
     *
     * @param \Illuminate\Http\Request $request The incoming HTTP request containing query parameters.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index (Request $request) 
    {
        $perPage = $request->input('perPage'); // Get the per-page pagination limit from the request
        $sortOrder = $request->input('sortOrder', 'asc'); // Default to ascending order if not specified

        // Validate sortOrder to ensure it’s either 'asc' or 'desc'
        if (!in_array($sortOrder, ['asc', 'desc'])) {
            $sortOrder = 'asc';
        }

        // Start with the base query
        $query = Movie::query()->with('ratings');

        // Filtering by genre 
        if ($request->has('genre')) {
            $query->where('genre', $request->input('genre'));
        }

        // Filtering by director 
        if ($request->has('director')) {
            $query->where('director', $request->input('director'));
        }

        // Sorting by release_year
        $query->orderBy('release_year', $sortOrder);

        // Retrieve paginated movies with ratings
        $movies = $query->paginate($perPage);

        return response()->json($movies);
    }

    /**
     * Store a newly created movie in the database.
     * 
     * @param \App\Http\Requests\MovieRequest $request The validated request containing movie data.
     * @return \App\Models\Movie
     */
    public function store(MovieRequest $request) 
    {
        return Movie::create( [
            'title'       => $request->title,
            'director'    => $request->director,
            'genre'       => $request->genre,
            'release_year'=> $request->release_year,
            'description' => $request->description,
        ] );
    }

    /**
     * Update an existing movie in the database.
     * 
     * @param \App\Models\Movie $movie The movie instance to be updated.
     * @param \App\Http\Requests\MovieRequest $request The validated request containing updated movie data.
     * @return \App\Models\Movie
     */
    public function update(Movie $movie, MovieRequest $request) 
    {
        $movie->update( [
            'title'        => $request->filled( 'title' ) ? $request->title : $movie->title,
            'director'     => $request->filled( 'director' ) ? $request->director : $movie->director,
            'genre'        => $request->filled( 'genre' ) ? $request->genre : $movie->genre,
            'release_year' => $request->filled( 'release_year' ) ? $request->release_year : $movie->release_year,
            'description'  => $request->filled( 'description' ) ? $request->description : $movie->description,
            ] );
            return $movie;
    }

    /**
     * Delete a movie from the database.
     * 
     * @param \App\Models\Movie $movie The movie instance to be deleted.
     * @return \App\Models\Movie
     */
    public function delete(Movie $movie) 
    {
        $movie->delete();
        return $movie;
    }
}
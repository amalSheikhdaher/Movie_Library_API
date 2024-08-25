<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Services\MovieService;
use App\Http\Requests\MovieRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Trait\ApiResponseTrait;
use App\Http\Resources\MovieResource;

class MovieController extends Controller
{
    // This trait provides standardized methods for API responses.
    use ApiResponseTrait;
    protected MovieService $movieService;

    /**
 * Constructs a new MovieController instance.
 *
 * @param MovieService $movieService The movie service to use.
 */

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    /**
     * Display a listing of the resource.

     * Retrieves a list of movies.
     *
     * @param Request $request The request object.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // Calls the service to get a list of movies
        $data = $this->movieService->index($request);

        // Returns the list of movies as a JSON response.
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     * @param MovieRequest $request The request object.
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(MovieRequest $request)
    {
        try{
            $data = $this->movieService->store($request);
             // Returns the newly created movie resource as a JSON response with a success message.
            return $this->responseApi(new MovieResource($data), 'Movie Store Successfully', 201);
        }catch(\Exception $e ){
            Log::error($e);  // Logs the exception if something goes wrong.
            return $this->responseApi(null, 'Movie Store failed', 422);
        }
    }

    /**
     * Display the specified resource.
     * 
     * @param Movie $movie The movie object.
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Movie $movie)
    {
        $data = new MovieResource($movie);
        $rating = $movie->ratings;
        return $this->responseApi([new MovieResource($data),'ratings'=>$rating], 'Single Movie data Show', 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MovieRequest $request The request object.
     * @param Movie $movie The movie object.
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(MovieRequest $request, Movie $movie)
    {
        try{
            $data = $this->movieService->update($movie, $request);
            return $this->responseApi(new MovieResource($data), 'Movie Update Successfully', 200);
        }catch(\Exception $e ){
            Log::error($e);
            return $this->responseApi(null, 'Movie Update failed', 422);
        }
    }

    /**
     * Remove the specified resource.
     * 
     * @param Movie $movie The movie object.
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Movie $movie)
    {
        try{
            $data = $this->movieService->delete($movie);
            return $this->responseApi(new MovieResource($data), 'Movie Delete Successfully', 200);
        }catch(\Exception $e ){
            Log::error($e);
            return $this->responseApi(null, 'Movie Delete failed', 422);
        }
    }
}

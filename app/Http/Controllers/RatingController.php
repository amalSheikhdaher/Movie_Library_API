<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\RatingRequest;
use App\Http\Trait\ApiResponseTrait;
use App\Http\Resources\RatingResource;

class RatingController extends Controller
{
    // This trait is used to standardize API responses
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  \App\Http\Requests\RatingRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RatingRequest $request)
    {
        try{
             // Create a new Rating entry with the data provided in the request.
            $rating = Rating::create( [
                'user_id'  => $request->user_id,
                'movie_id' => $request->movie_id,
                'rating'   => $request->rating,
                'review'   => $request->review,
            ] );
            // Return a successful API response with the created Rating resource.
            return $this->responseApi(new RatingResource($rating), 'Rate create Successfully', 201);
        
        }catch(\Exception $e ){
            // Log the error for debugging purposes and return an error response.
            Log::error($e);
            return $this->responseApi(null, 'Rating Store failed', 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  \App\Http\Requests\RatingRequest  $request
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RatingRequest $request, Rating $rating)
    {
         // Update the rating instance with the new data from the request.
        $rating->update([
            $rating->user_id  = $request->user_id,
            $rating->movie_id = $request->movie_id,
            $rating->rating   = $request->rating,
            $rating->review   = $request->review,
        ]);
        
        return $this->responseApi(new RatingResource($rating), 'Rate update Successfully', 200);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Rating $rating)
    {
        $rating->delete();

        return $this->responseApi(new RatingResource($rating), 'Rating deleted Successfully', 200);
    }
}

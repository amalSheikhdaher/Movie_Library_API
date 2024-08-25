<?php

namespace App\Http\Trait;

trait ApiResponseTrait{
    /**
     * Return a standardized JSON response for API endpoints.
     * 
     * This method is used to create a consistent API response structure
     * throughout the application. It accepts data, a message, and an HTTP status
     * code, and returns a JSON response with those elements.
     *
     * @param mixed  $data    The data to be returned in the response, typically a resource or collection.
     * @param string $message A message that provides context about the response, such as success or error details.
     * @param int    $status  The HTTP status code for the response (e.g., 200 for OK, 201 for created, 422 for unprocessable entity).
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseApi($data, $message, $status){
        $array = [
            'data' => $data,
            'message' => $message,
        ];
        return response()->json($array,$status);
    }
}
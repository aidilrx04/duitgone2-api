<?php

namespace App\Support;

use Illuminate\Http\JsonResponse;

class InvalidRequestResponse
{
    public static function notAllowed(): JsonResponse
    {
        return response()->json([
            'error' => 'Operation not allowed'
        ], 403);
    }

    public static function notFound(): JsonResponse
    {
        return response()->json([
            'error' => 'Not Found'
        ], 404);
    }
}

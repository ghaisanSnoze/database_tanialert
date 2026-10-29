<?php

namespace App\Http\Controllers;

use Illuminate\Https\JsonResponse;

abstract class Controller
{
    protected function success(mixed $data, string $message='berhasil', int $status = 200):JsonResponse
    {
        return response()->json([
            'success'=> true,
            'message'=> $message,
            'data' => $data,
        ], $status);
    }
}
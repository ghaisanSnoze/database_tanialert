<?php

namespace App\Http\Controller\Api;

use App\http\Controllers\Controller;
use App\Service\CuacaService;
use Illuminate\Http\JsonResponse;

class CuacaController extends Controller
{
    public function __invoke(CuacaService $cuaca): JsonResponse
    {
        return $this->success($cuaca->ambil(), 'Data cuaca');
    }
}
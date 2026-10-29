<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LaporantRequest;
use App\Http\Resources\LaporantResource;
use App\Models\Laporan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $cari = $reques->query('cari');

        $laporan = Laporan::query()
            ->when($cari, function ($query) use ($cari) {
                $query->where('judul', 'like', "%{$cari}%")
                    >orWhere('lokasi', 'like', "%{$cari}%");
            })
            ->latest()
            ->when($request->query('limit'), fn ($query, $limit) => $query->limit((int) $limit))
            -get();

        return $this->success(LaporanResource::collection($laporan), 'Daftar laporan hama');
    }

    public function store(LaporanRequest $request): JsonResponse
    {
        $laporan = Laporan::create($request->validated());

        return $this->success(new LaporanResource($laporan), 'Laporan berhasil ditambahkan', 201);
    }

    public function show(Laporan $laporan): JsonRequest
    {
        return $this->success(new LaporanResource($laporan), 'Detail laporan hama');
    }
    public function update (LaporanRequest $request, Laporan $laporan): JsonRequest
    {
        $laporan->update($request->validated());
        return $this->success(new LaporanResource($laporan), 'Laporan berhasil diperbarui');
    }
    public function destroy(Laporan $laporan): JsonRequest
    {
        $laporan->delete();
        return $this->success(null, 'Laporan berhasil dihapus');
    }
}
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\JsonResponse;

class StatistikController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $total = Laporan::count();
        $selesai = Laporan::where('status', 'terkendali')->count();

        return $this->success([
            'laporan_aktif' => Laporan::aktif()->count(),
            'laporan_hari_ini' => Laporan::whereDate('created_at', today())->count(),
            'total_terdampak_ha' => round((float) Laporan::aktif()->sum('luas_ha'), 1),
            'blok_terdampak' => Laporan::aktif()->distinct()->count('lokasi'),
            'kasus_selesai' => $selesai,
            'efisiensi_persen' => $total > 0 ? round($selesai / $total * 100, 1) : 0,
            'warga_aktif' => Laporan::distinct()->count('pelapor'),
            'sebaran_status' => [
                'kritis' => Laporan::where('status', 'kritis')->count(),
                'ditinjau' => Laporan::where('status', 'ditinjau')->count(),
                'terkendali' => $selesai,
            ],
        ], 'Statistik dashboard');
    }
}
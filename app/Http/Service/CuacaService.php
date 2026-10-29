<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class CuacaService
{
    public function ambil(): array
    {
        try {
            $data = Http::timeout(5)->get(config('cuaca.url'), [
                'latitude' => config('cuaca.lat'),
                'longitude' => config('cuaca.lon'),
                'current' => 'temperature_2m,relative_humidity_2m,wind_speed_10m,weather_code',
                'daily' => 'weather_code,temperature_2m_max,precipitation_sum',
                'timezone' => 'Asia/Jakarta',
            ])->throw()->json();
        } catch (\Throwable $e) {
            return $this->cadangan();
        }

        $prakiraan = [];
        foreach ($data['daily']['time'] as $i => $tanggal) {
            $prakiraan[] = [
                'hari' => Carbon::parse($tanggal)->locale('id')->isoFormat('ddd'),
                'kondisi' => $this->kondisi($data['daily']['weather_code'][$i]),
                'suhu' => (int) round($data['daily']['temperature_2m_max'][$i]),
            ];
        }

        return [
            'sumber' => 'langsung',
            'suhu' => (int) round($data['current']['temperature_2m']),
            'kondisi' => $this->kondisi($data['current']['weather_code']),
            'kelembaban' => (int) $data['current']['relative_humidity_2m'],
            'angin_kmh' => (int) round($data['current']['wind_speed_10m']),
            'curah_hujan_mm' => (float) $data['daily']['precipitation_sum'][0],
            'prakiraan' => $prakiraan,
        ];
    }

    private function kondisi(int $kode): string
    {
        return match (true) {
            $kode === 0 => 'Cerah',
            $kode <= 2 => 'Sebagian Berawan',
            $kode <= 48 => 'Berawan',
            $kode <= 82 => 'Hujan',
            default => 'Badai Petir',
        };
    }

    private function cadangan(): array
    {
        $prakiraan = [];
        foreach (['Sen' => 29, 'Sel' => 28, 'Rab' => 30, 'Kam' => 29, 'Jum' => 27, 'Sab' => 28, 'Min' => 30] as $hari => $suhu) {
            $prakiraan[] = ['hari' => $hari, 'kondisi' => 'Sebagian Berawan', 'suhu' => $suhu];
        }

        return [
            'sumber' => 'cadangan',
            'suhu' => 29,
            'kondisi' => 'Sebagian Berawan',
            'kelembaban' => 76,
            'angin_kmh' => 12,
            'curah_hujan_mm' => 3.0,
            'prakiraan' => $prakiraan,
        ];
    }
}

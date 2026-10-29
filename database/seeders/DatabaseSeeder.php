<?php

namespace Database\Seeders;

use App\Models\Laporan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // [judul, lokasi, pelapor, luas (ha), status]
        $data = [
            ['Serangan Wereng Coklat Parah', 'Blok Sawah Lor', 'Pak Mulyadi', 1.2, 'kritis'],
            ['Ulat Grayak Makan Daun Muda', 'Blok Sawah Kulon', 'Ibu Sumiati', 0.8, 'ditinjau'],
            ['Blast Padi Daun Mengering', 'Blok Sawah Wetan', 'Pak Heri', 1.5, 'terkendali'],
            ['Tikus Sawah Massal', 'Blok Sawah Lor', 'Ibu Aminah', 2.1, 'kritis'],
            ['Penggerek Batang Padi', 'Blok Sawah Tengah', 'Pak Wayan', 0.8, 'ditinjau'],
        ];

        foreach ($data as $i => [$judul, $lokasi, $pelapor, $luas, $status]) {
            Laporan::create([
                'judul' => $judul,
                'lokasi' => $lokasi,
                'pelapor' => $pelapor,
                'luas_ha' => $luas,
                'status' => $status,
                'created_at' => now()->subDays($i),
            ]);
        }
    }
}

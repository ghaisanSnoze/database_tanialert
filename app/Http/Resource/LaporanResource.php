<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LaporanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'kode' => sprintf('A%02d-%d', $this->id, $this->created_at->year),
            'judul' => $this->judul,
            'lokasi' => $this->lokasi,
            'pelapor' => $this->pelapor,
            'luas_ha' => $this->luas_ha,
            'status' => $this->status,
            'tanggal' => $this->created_at->toDateString(),
        ];
    }
}

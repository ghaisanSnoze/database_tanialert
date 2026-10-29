<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class LaporanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $wajib = $this->isMethod('post') ? 'required' : 'sometimes';

        return [
            'judul' => [$wajib, 'string', 'max:150'],
            'lokasi' => [$wajib, 'string', 'max:100'],
            'pelapor' => ['sometimes', 'string', 'max:100'],
            'luas_ha' => ['nullable', 'numeric', 'min:0', 'max:999'],
            'status' => ['sometimes', 'in:kritis,ditinjau,terkendali'],
        ];
    }

    public function messages(): array
    {
         return [
            'required' => ':Attribute wajib diisi.',
            'string' => ':Attribute harus berupa teks.',
            'numeric' => ':Attribute harus berupa angka.',
            'in' => 'Pilihan :attribute tidak valid.',
            'min' => ':Attribute minimal :min.',
            'max' => ':Attribute maksimal :max.',
        ];
    }
}
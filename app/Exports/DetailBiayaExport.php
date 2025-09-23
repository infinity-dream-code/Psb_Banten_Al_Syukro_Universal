<?php

namespace App\Exports;

use App\Models\DataPeserta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DetailBiayaExport implements FromCollection, WithHeadings
{
    protected $columns;

    public function __construct()
    {
        $all = DataPeserta::with('masterHarga')->get()->pluck('masterHarga.detail')->filter();
        $this->columns = collect($all)
            ->flatten(1)
            ->pluck('nama_tagihan')
            ->unique()
            ->values()
            ->toArray();
    }

    public function collection()
    {
        $peserta = DataPeserta::with('masterHarga')->get();

        return $peserta->map(function ($p, $i) {
            $row = [
                'no' => $i + 1,
                'no_pendaftaran' => $p->no_pendaftaran,
                'nama' => $p->nama_peserta,
                'jenis_kelamin' => $p->gender,
            ];

            foreach ($this->columns as $col) {
                $row[$col] = 0;
            }

            foreach ($p->masterHarga?->detail ?? [] as $item) {
                if (isset($row[$item['nama_tagihan']])) {
                    $row[$item['nama_tagihan']] = $item['biaya'];
                }
            }

            return $row;
        });
    }

    public function headings(): array
    {
        return array_merge(
            ['No', 'No Pendaftar', 'Nama', 'Jenis Kelamin'],
            $this->columns
        );
    }
}

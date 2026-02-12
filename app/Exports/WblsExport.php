<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class WblsExport implements 
    FromQuery, 
    WithHeadings, 
    WithMapping, 
    ShouldAutoSize,
    WithStyles
{
    protected Builder $query;

    public function __construct(Builder $query)
    {
        $this->query = $query;
    }

    public function query()
    {
        return $this->query->with('status');
    }

    public function headings(): array
    {
        return [
            'No',
            'No WBS',
            'Tanggal Pengaduan',
            'Perihal',
            'Status Proses',
            'Keterangan',
        ];
    }

    public function map($row): array
    {
        static $no = 1;

        return [
            $no++,
            $row->i_wbls ?? '-',
            $row->d_wbls ? Carbon::parse($row->d_wbls)->format('d M Y') : '-',
            $row->status->n_wbls_stat ?: '-',
            strip_tags($row->status->e_wbls_stat) ?: '-',
            $row->e_wbls_stat ?: '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [ 
                'font' => ['bold' => true],
            ],
        ];
    }
}
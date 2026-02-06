<?php

namespace App\Exports;

use App\Models\Tmwbls;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class WblsExport implements FromQuery, WithHeadings, WithMapping
{
    protected Builder $query;

    public function __construct(Builder $query)
    {
        $this->query = $query;
    }

    public function query()
    {
        return $this->query;
    }

    public function headings(): array
    {
        return [
            'No',
            'Judul Laporan',
            'Status',
            'Tanggal Lapor',
        ];
    }

    public function map($row): array
    {
        static $no = 1;

        return [
            $no++,
            $row->n_wbls_title,
            $row->c_wbls_stat,
            \Carbon\Carbon::parse($row->d_entry)->format('d-m-Y'),

        ];
    }
}
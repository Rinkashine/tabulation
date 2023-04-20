<?php

namespace App\Exports;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GenderExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Customer::select([
            DB::raw('gender'),
            DB::raw(value : 'COUNT(gender) AS total'),
        ])->groupBy('gender')
        ->get();
    }

    public function headings(): array
    {
        return [
            'Gender',
            'Total',
        ];
    }
}

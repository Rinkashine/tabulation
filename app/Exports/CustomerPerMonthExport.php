<?php

namespace App\Exports;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CustomerPerMonthExport implements  FromCollection, ShouldAutoSize,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Customer::select([
            DB::raw(value: 'YEAR(created_at) as year'),
            DB::raw(value: 'MONTHNAME(created_at) as month_name'),
            DB::raw(value: 'MONTH(created_at) as month'),
            DB::raw(value: 'COUNT(name) as total'),
        ])
        ->groupBy('month_name', 'year','month')
        ->orderBy('year','asc')
        ->orderBy('month','asc')
        ->get(); 
    }

    public function map($customers): array
    {
        return [
            $customers->year,
            $customers->month_name,
            $customers->total,
        ];
    }
    public function headings(): array
    {
        return [
            'Year',
            'Month',
            'Total Customers'
        ];
    }
}

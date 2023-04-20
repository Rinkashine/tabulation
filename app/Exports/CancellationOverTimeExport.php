<?php

namespace App\Exports;

use App\Models\CustomerOrder;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CancellationOverTimeExport implements FromCollection,WithHeadings,ShouldAutoSize,WithMapping
{
    public function collection()
    {
        return CustomerOrder::select([
            DB::raw(value: 'YEAR(customer_order.created_at) as year'),
            DB::raw(value: 'MONTHNAME(customer_order.created_at) as month_name'),
            DB::raw(value: 'MONTH(customer_order.created_at) as month'),
            DB::raw(value: 'COUNT(*) as total'),
        ])
        ->where('customer_order.status','Cancelled')
        ->groupBy('month_name', 'year','month')
        ->orderBy('year','asc')
        ->orderBy('month','asc')
        ->get();
    }
    public function map($sales): array
    {
        return [
            $sales->year,
            $sales->month_name,
            $sales->total,
        ];
    }
    public function headings(): array
    {
        return [
            'Year',
            'Month',
            'Total Cancellations'
        ];
    }
}

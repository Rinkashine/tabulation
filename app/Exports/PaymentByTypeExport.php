<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\CustomerOrder;
use Illuminate\Support\Facades\DB;

class PaymentByTypeExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $startdate,$enddate;
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($startdate,$enddate){
        $this->startdate = $startdate;
        $this->enddate = $enddate;
    }

    public function collection()
    {
        return CustomerOrder::select([
            DB::raw('mode_of_payment AS type'),
            DB::raw(value: 'COUNT(mode_of_payment) AS total'),
        ])->where('status',"Completed")
        ->where('created_at', '>=', $this->startdate)
        ->where('created_at', '<=', $this->enddate)
        ->groupBy('mode_of_payment')
        ->get();
    }

    public function map($data): array
    {
        return [
            $data->type,
            $data->total
        ];
    }

    public function headings(): array
    {
        return [
            'Mode of Payment',
            'Sessions',
        ];
    }
}

<?php

namespace App\Exports;

use App\Models\CancellationReason;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class CancellationReasonsExport implements FromCollection,WithHeadings,ShouldAutoSize,WithMapping
{
    protected $startdate,$enddate,$sorting,$column_name,$order_name;

    function __construct($sorting,$startdate,$enddate){
        $this->sorting = $sorting;
        $this->startdate = $startdate;
        $this->enddate = $enddate;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if($this->sorting == 'customer_name_asc'){
            $this->column_name = "customers.name";
            $this->order_name = "asc";
        }elseif($this->sorting == 'customer_name_desc'){
            $this->column_name = "customers.name";
            $this->order_name = 'desc';
        }elseif($this->sorting == 'total_spent_asc'){
            $this->column_name = 'total';
            $this->order_name = "asc";
        }elseif($this->sorting == 'total_spent_desc'){
            $this->column_name = 'total';
            $this->order_name = 'desc';
        }
        return CancellationReason::select([
            'name',
            'cancellation_reason.id',
            DB::raw(value: 'COUNT(CASE WHEN customer_order.status = "Cancelled" then customer_order.cancellation_reason_id end) as total'),
        ])
        ->leftjoin('customer_order',function($join){
            $join->on('cancellation_reason.id', '=', 'customer_order.cancellation_reason_id')
            ->where('customer_order.created_at', '>=', $this->startdate)
            ->where('customer_order.created_at','<=',$this->enddate);
        })
        
        ->groupBy('name','cancellation_reason.id')
        ->orderBy('cancellation_reason.id')
        ->get();
    }

    public function map($cancellation): array
    {
        return [
            $cancellation->name,
            number_format($cancellation->total),

        ];
    }

    public function headings(): array
    {
        return [
            'Cancellation Reason',
            'Total Cancellations'
        ];
    }
}

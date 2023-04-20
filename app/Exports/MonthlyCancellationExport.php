<?php

namespace App\Exports;

use App\Models\CustomerOrder;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MonthlyCancellationExport implements FromCollection,ShouldAutoSize,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    function __construct($month,$year, $startdate,$enddate){
        // $this->sorting = $sorting;
        $this->startdate = $startdate;
        $this->enddate = $enddate;
        // dd($enddate);
    }
    public function collection()
    {
        return CustomerOrder::select([
            'customers.name as customer_name',
            'customer_order.id as id',
            'cancellation_reason.name as reason_name',

            DB::raw(value: 'COUNT(CASE WHEN customer_order.status = "Cancelled" then customer_order.cancellation_reason_id end) as total'),
        ])
        
        ->leftjoin('cancellation_reason',function($join){
            $join->on('cancellation_reason.id', '=', 'customer_order.cancellation_reason_id');
        })
        ->where('customer_order.created_at', '>=', $this->startdate)
        ->where('customer_order.created_at', '<=', $this->enddate.' 23:59:59')
        ->where('customer_order.status','Cancelled' )
        ->leftjoin('customers', 'customers.id', '=', 'customer_order.customers_id')
        ->groupBy('customer_order.id','cancellation_reason.name','customers.name')
        // ->orderBy($this->column_name, $this->order_name)
        ->get();

    }
    public function map($cancellations): array
    {
        return [
            $cancellations->id,
            $cancellations->customer_name,
            $cancellations->reason_name,
        ];
    }
    public function headings(): array
    {
        return [
            'Order ID',
            'Customer Name',
            'Cancellation Reason'
        ];
    }
}

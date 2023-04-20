<?php

namespace App\Exports;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class CancelledOrdersExport implements FromCollection,WithHeadings,ShouldAutoSize,WithMapping
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
        return Customer::select([
            'customers.id',
            'customers.name',
            'customers.email',
            DB::raw(value: 'COUNT(CASE WHEN customer_order.status = "Cancelled" and customer_order.created_at >= "'.$this->startdate.'" and customer_order.created_at <= "'.$this->enddate.'" then customer_order.cancellation_reason_id end) as total'),    
        ])
        ->leftjoin('customer_order','customers.id','=','customer_order.customers_id')
        ->groupBy('customers.name','customers.id','customers.email')
        ->orderBy($this->column_name, $this->order_name)
        ->get();
    }

    public function map($customer): array
    {
        return [
            $customer->name,
            $customer->email,
            number_format($customer->total),

        ];
    }

    public function headings(): array
    {
        return [
            'Customer Name',
            'Customer Email',
            'Total Cancellations'
        ];
    }
}

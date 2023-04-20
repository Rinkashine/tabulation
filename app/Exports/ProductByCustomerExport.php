<?php

namespace App\Exports;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProductByCustomerExport implements FromCollection,ShouldAutoSize,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    function __construct($sorting, $startdate,$enddate, $product_name, $product_id){
        $this->sorting = $sorting;
        $this->startdate = $startdate;
        $this->enddate = $enddate;
        $this->product_name = $product_name;
        $this->product_id = $product_id;
        
    }
    public function collection()
    {
        // dd($this->product_id);
         if($this->sorting == 'customer_name_asc'){
            $this->column_name = "name";
            $this->order_name = "asc";
        }elseif($this->sorting == 'customer_name_desc'){
            $this->column_name = "name";
            $this->order_name = 'desc';
        }elseif($this->sorting == 'total_spent_asc'){
            $this->column_name = 'total_quantity';
            $this->order_name = "asc";
        }elseif($this->sorting == 'total_spent_desc'){
            $this->column_name = 'total_quantity';
            $this->order_name = 'desc';
        }else{
            $this->column_name = "name";
            $this->order_name = "asc";
        }

        return $customers = Customer::select([
            'customers.id',
            'customers.name',
            'customers.email',
            
            DB::raw(value: 'SUM(CASE WHEN customer_order.status = "Completed" then customer_order_item.quantity end) AS total_quantity')
        ])
        ->leftjoin('customer_order','customers.id','=','customer_order.customers_id')
        ->leftjoin('customer_order_item',function($join){
            $join->on('customer_order_item.customer_order_id', '=', 'customer_order.id')
            ->where('customer_order_item.product_id', '=', $this->product_id)
            ->where('customer_order.created_at', '>=', $this->startdate)
            ->where('customer_order.created_at', '<=', $this->enddate);
        })
        ->groupBy('customers.name','customers.id','customers.email')
        ->orderBy($this->column_name, $this->order_name )
        ->get();
        // dd($customers->toArray());
    }
    public function map($customers): array
    {
        return [
            $customers->name,
            $customers->email,
            number_format($customers->total_quantity),
        ];
    }
    public function headings(): array
    {
        return [
            'Customer Name',
            'Customer Email',
            'Total Ordered Products',
        ];
    }
}

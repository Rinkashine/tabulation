<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CustomerByProductExport implements FromCollection, ShouldAutoSize,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    function __construct($name, $id){
        $this->name = $name;
        $this->customer_id = $id;        
    }
    public function collection()
    {
        return Product::select([
            'product.name',
            
            DB::raw(value: 'SUM(CASE WHEN customer_order.status = "Completed" then customer_order_item.quantity end) AS total_quantity')
        ])
        ->leftjoin('customer_order_item','product.id','=','customer_order_item.product_id')
        ->leftjoin('customer_order',function($join){
            $join->on('customer_order_item.customer_order_id', '=', 'customer_order.id')
            ->where('customer_order.customers_id', '=', $this->customer_id);
            // ->where('customer_order.created_at', '>=', $this->from)
            // ->where('customer_order.created_at', '<=', $this->to);
        })
        // ->where('product.name','like','%'.$this->search.'%')
        ->groupBy('product.name')
        ->orderBy('total_quantity', 'desc')
        ->get();
    }
    public function map($products): array
    {
        return [
            $products->name,
            number_format($products->total_quantity),
        ];
    }
    public function headings(): array
    {
        return [
            'Product Name',
            // 'Customer Email',
            'Total Ordered Products',
        ];
    }
}

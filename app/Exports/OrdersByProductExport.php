<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class OrdersByProductExport implements FromCollection, ShouldAutoSize,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::select([
            'product.id',
            'product.name',
            DB::raw(value: 'SUM(CASE WHEN customer_order.status = "Completed" then customer_order_item.quantity  
            end) as order_quantity'),
            // DB::raw(value: 'COUNT(CASE WHEN customer_order.status = "Completed" then customer_order_item.product_name end) as order_total'),
            // DB::raw(value: '(SUM(CASE WHEN customer_order.status = "Completed" then (customer_order_item.quantity*customer_order_item.price) 
            // else "0" end)) as total_sales'),
        ])
        ->leftjoin('customer_order_item', 'product.name', '=', 'customer_order_item.product_name')
        ->leftjoin('customer_order', function($join){
            $join->on('customer_order_item.customer_order_id', '=', 'customer_order.id');
            
        })
        ->groupBy('product.name','product.id' )
        ->orderBy('name', 'asc')
        ->get();
    }
    public function map($product): array
    {
        return [
            $product->name,
            number_format($product->order_quantity),
        ];
    }
    public function headings(): array
    {
        return [
            'Product Name',
            'Total Ordered Products',
        ];
    }
}

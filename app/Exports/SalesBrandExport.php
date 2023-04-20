<?php

namespace App\Exports;

use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SalesBrandExport implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping
{
    protected $startdate;

    protected $enddate;

    protected $sorting;

    protected $column_name;

    protected $order_name;

    public function __construct($sorting, $startdate, $enddate)
    {
        $this->sorting = $sorting;
        $this->startdate = $startdate;
        $this->enddate = $enddate;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if ($this->sorting == 'brand_name_asc') {
            $this->column_name = 'name';
            $this->order_name = 'asc';
        } elseif ($this->sorting == 'brand_name_desc') {
            $this->column_name = 'name';
            $this->order_name = 'desc';
        } elseif ($this->sorting == 'total_sales_asc') {
            $this->column_name = 'total_sales';
            $this->order_name = 'asc';
        } elseif ($this->sorting == 'total_sales_desc') {
            $this->column_name = 'total_sales';
            $this->order_name = 'desc';
        } else {
            $this->column_name = 'name';
            $this->order_name = 'asc';
        }

        return Brand::select([
            'brand.id',
            'brand.name',
            DB::raw(value: 'SUM(CASE WHEN customer_order.status = "Completed" then customer_order_item.quantity * customer_order_item.price else 0 end) as total_sales'),
        ])->leftjoin('product', 'brand.id', '=', 'product.brand_id')
            ->leftjoin('customer_order_item', 'product.id', '=', 'customer_order_item.id')
            ->leftjoin('customer_order', function ($join) {
                $join->on('customer_order_item.customer_order_id', '=', 'customer_order.id')
                ->where('customer_order.created_at', '>=', $this->startdate)
                ->where('customer_order.created_at', '<=', $this->enddate);
            })
            ->groupBy('brand.id', 'brand.name')
            ->orderBy($this->column_name, $this->order_name)
            ->get();
    }

    public function map($brand): array
    {
        return [
            $brand->name,
            number_format($brand->total_sales, 2),

        ];
    }

    public function headings(): array
    {
        return [
            'Brand Name',
            'Total Sales',
        ];
    }
}

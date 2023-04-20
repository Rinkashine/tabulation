<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductRatingsExport implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping
{
    protected $sorting;

    protected $column_name;

    protected $order_name;

    protected $startdate;

    protected $enddate;

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
        if ($this->sorting == 'product_name_asc') {
            $this->column_name = 'product.name';
            $this->order_name = 'asc';
        } elseif ($this->sorting == 'product_name_desc') {
            $this->column_name = 'product.name';
            $this->order_name = 'desc';
        } elseif ($this->sorting == 'total_number_asc') {
            $this->column_name = 'total';
            $this->order_name = 'asc';
        } elseif ($this->sorting == 'total_number_desc') {
            $this->column_name = 'total';
            $this->order_name = 'desc';
        } elseif ($this->sorting == 'total_rating_asc') {
            $this->column_name = 'rate';
            $this->order_name = 'asc';
        } elseif ($this->sorting == 'total_rating_desc') {
            $this->column_name = 'rate';
            $this->order_name = 'desc';
        } elseif ($this->sorting == 'ratingLow') {
            $this->column_name = 'ave';
            $this->order_name = 'asc';
        } elseif ($this->sorting == 'ratingHigh') {
            $this->column_name = 'ave';
            $this->order_name = 'desc';
        } else {
            $this->column_name = 'product.name';
            $this->order_name = 'asc';
        }

        return Product::select([
            'product.name',
            'product.id',

            DB::raw(value: 'COUNT(CASE WHEN product_review.customer_order_item_id = customer_order_item.id then product.id end) AS total'),
            DB::raw(value: 'SUM(CASE WHEN product_review.customer_order_item_id = customer_order_item.id then rate end) AS rate'),
            DB::raw(value: '(SUM(CASE WHEN product_review.customer_order_item_id = customer_order_item.id then rate end)/COUNT(CASE WHEN product_review.customer_order_item_id = customer_order_item.id then product.id end)) AS ave')
        ])
        ->leftjoin('customer_order_item', 'product.id', '=', 'customer_order_item.product_id')
        ->leftjoin('product_review',function($join){
            $join->on('product_review.customer_order_item_id', '=', 'customer_order_item.id')
            ->where('product_review.created_at', '>=', $this->startdate)
            ->where('product_review.created_at', '<=', $this->enddate);
        })
        ->groupBy('product.id','product.name')
        ->orderBy($this->column_name, $this->order_name)
        ->get();
    }

    public function map($product): array
    {
        return [
            $product->name,
            number_format($product->total,2),
            number_format($product->rate,2),
            number_format($product->ave,2)
        ];
    }

    public function headings(): array
    {
        return [
            'Product Name',
            'Number of Ratings',
            'Total Stars',
            'Rating'
        ];
    }
}

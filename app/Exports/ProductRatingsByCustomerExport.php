<?php

namespace App\Exports;

use App\Models\Review;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProductRatingsByCustomerExport implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping
{
    protected $sorting;

    protected $column_name;

    protected $order_name;

    protected $startdate;

    protected $enddate;

    public function __construct($sorting, $startdate, $enddate, $name, $product_id)
    {
        $this->sorting = $sorting;
        $this->startdate = $startdate;
        $this->enddate = $enddate;
        $this->product_name = $name;
        $this->product_id = $product_id;
        // dd($this->product_id);
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if ($this->sorting == 'customer_name_asc') {
            $this->column_name = 'customers.name';
            $this->order_name = 'asc';
        } elseif ($this->sorting == 'customer_name_desc') {
            $this->column_name = 'customers.name';
            $this->order_name = 'desc';
        } elseif ($this->sorting == 'recent') {
            $this->column_name = 'product_review.created_at';
            $this->order_name = 'desc';
        } elseif ($this->sorting == 'total_rating_asc') {
            $this->column_name = 'rate';
            $this->order_name = 'asc';
        } elseif ($this->sorting == 'total_rating_desc') {
            $this->column_name = 'rate';
            $this->order_name = 'desc';
        }

        return Review::join('customer_order_item', 'product_review.customer_order_item_id', '=', 'customer_order_item.id')
        ->leftjoin('customers','customers.id','=','product_review.customer_id')
        ->select([
            'rate',
            'customer_order_item.customer_order_id', 'customers.name',
            DB::raw('(SELECT customers.name FROM customers WHERE customers.id = product_review.customer_id) as customer_name'),
            DB::raw('(SELECT customers.photo FROM customers WHERE customers.id = product_review.customer_id) as customer_photo'),
            'product_review.created_at'])
        ->where('product_id', $this->product_id)
        ->where('product_review.created_at', '>=', $this->startdate)
        ->where('product_review.created_at', '<=', $this->enddate)
        ->orderby($this->column_name, $this->order_name)
        ->get();
    }
    public function map($rating): array
    {
        return [
            $rating->customer_order_id,
            $rating->name,
            $rating->rate
        ];
    }

    public function headings(): array
    {
        return [
            'Order ID',
            'Customer Name',
            'Rate',
        ];
    }
}

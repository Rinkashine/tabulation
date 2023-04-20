<?php

namespace App\Exports;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CustomerSpentExport implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping
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
        if ($this->sorting == 'customer_name_asc') {
            $this->column_name = 'name';
            $this->order_name = 'asc';
        } elseif ($this->sorting == 'customer_name_desc') {
            $this->column_name = 'name';
            $this->order_name = 'desc';
        } elseif ($this->sorting == 'total_spent_asc') {
            $this->column_name = 'total_spent';
            $this->order_name = 'asc';
        } elseif ($this->sorting == 'total_spent_desc') {
            $this->column_name = 'total_spent';
            $this->order_name = 'desc';
        } else {
            $this->column_name = 'name';
            $this->order_name = 'asc';
        }

        return Customer::select([
            'customers.id',
            'customers.name',
            'customers.email',
            DB::raw(value: 'sum(CASE WHEN customer_order.status = "Completed" then customer_order_item.price * customer_order_item.quantity else 0 end) AS total_spent'),
        ])
        ->leftjoin('customer_order', 'customers.id', '=', 'customer_order.customers_id')
        ->leftjoin('customer_order_item', function ($join) {
            $join->on('customer_order_item.customer_order_id', '=', 'customer_order.id')
            ->where('customer_order.created_at', '>=', $this->startdate)
            ->where('customer_order.created_at', '<=', $this->enddate);
        })
        ->groupBy('customers.name', 'customers.id', 'customers.email')
        ->orderBy($this->column_name, $this->order_name)
        ->get();
    }

    public function map($customer): array
    {
        return [
            $customer->name,
            $customer->email,

            number_format($customer->total_spent),

        ];
    }

    public function headings(): array
    {
        return [
            'Customer Name',
            'Customer Email',
            'Total Spent',
        ];
    }
}

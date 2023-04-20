<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\SalesCustomer;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class NonVerifiedAccountExport implements FromCollection, ShouldAutoSize,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Customer::select('name', 'email')->where('email_verified_at','=', null)->orderBy('name')->get();
    }
    public function map($customer): array
    {
        return [
            $customer->name,
            $customer->email,
        ];
    }

    public function headings(): array
    {
        return [
            'Customer Name',
            'Customer Email',
        ];
    }
}

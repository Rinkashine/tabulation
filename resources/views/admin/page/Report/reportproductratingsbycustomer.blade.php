@extends('admin.layout.admin')
@section('content')
@section('title', 'Product Ratings by Customer Report')

{{-- <livewire:report.product-ratings-by-customer-report/> --}}
@livewire('report.product-ratings-by-customer-report',[
    'product_id' => $product_id,
    'product_name' => $product_name,
    'from' => $from,
    'to' => $to
    ])

@endsection



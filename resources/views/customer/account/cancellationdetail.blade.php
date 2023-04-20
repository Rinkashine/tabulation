@extends('customer.layout.base')
@section('content')
@section('title', 'Order Details')
<!-- Begin: Header -->
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
            Welcome to Go Dental!
    </h2>
</div>
<!-- End: Header -->
<!-- Begin: Order Details Body -->
<div class="grid grid-cols-12 gap-6">
    <!-- BEGIN: Profile Menu -->
    @include('customer.component.side-profile')
    <!-- END: Profile Menu -->
    <!-- BEGIN: Display Information -->
    <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
        <div class="intro-y box lg:mt-5">
            <div class="flex justify-between items-center p-5 border-b border-slate-200/60">
                <div>
                    <h2 class="font-medium text-base mr-auto">
                        <a href="{{ url()->previous() }}" class="mr-2 btn">←</a> Order Details
                    </h2>
                </div>
                <div>
                    <div class="ml-2 px-2 py-2 bg-slate-200 text-slate-600  text-xs rounded-md">{{ $orderdetails->status }}</div>
                </div>
            </div>
            <div class="p-5">

                <div class="overflow-x-auto">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <th class="whitespace-nowrap">Product Name</th>
                            <th class="whitespace-nowrap text-center">Price</th>
                            <th class="whitespace-nowrap text-center">Quantity</th>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td class="whitespace-nowrap">{{ $product->product_name }}</td>
                                    <td class="whitespace-nowrap text-center">₱{{ number_format($product->price,2) }}</td>
                                    <td class="whitespace-nowrap text-center">{{ number_format($product->quantity) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="intro-y box mt-5 p-5">
            <div>
                Order ID:{{ $orderdetails->id }}
            </div>
            <div>
                Order Date: {{ $orderdetails->created_at->toFormattedDateString() }}
            </div>
            <div>
                Cancelled On: {{ $orderdetails->updated_at }}
            </div>
            <div>
                Mode of Payment: {{ $orderdetails->mode_of_payment }}
            </div>
            <div>
                Reason: {{ $orderdetails->cancellation_reason->name }}
            </div>
            @if($orderdetails->cancellation_details != null)
                <div>
                    Detailed Reason: {{ $orderdetails->cancellation_details }}
                </div>
            @endif
        </div>



    </div>
    <!-- BEGIN: Display Information -->
</div>
<!-- End: Order Details Body -->
@endsection


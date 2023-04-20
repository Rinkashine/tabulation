@extends('customer.layout.base')
@section('content')
@section('title', 'Cancelled Orders')
<!-- Begin: Header -->
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
            Cancelled Orders
    </h2>
</div>
<!-- End: Header -->
<!-- Begin: Canccelation Body -->
<div class="grid grid-cols-12 gap-6">
    <!-- BEGIN: Profile Menu -->
    @include('customer.component.side-profile')
    <!-- END: Profile Menu -->
    <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
        <!-- BEGIN: Display Information -->
        <div class="intro-y box lg:mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">
                    Order Cancellation
                </h2>
            </div>
            <div class="p-5">
                <div class="overflow-x-auto">
                    @forelse ($cancelledorders as $order)
                        <div class="mt-2 mb-5 border rounded-md">
                            <div class="flex flex-row justify-between px-3 py-5 border">
                                <div>
                                    #{{ $order->id }}
                                    <span class="text-danger">{{ $order->status }}</span>
                                </div>
                                <div class="px-2 rounded-full bg-slate-50">
                                    <span class="text-center whitespace-nowrap">
                                        <a href="{{ Route('cancellations.show',$order) }}">
                                            <i class="w-4 h-4 mr-1 fa-solid fa-eye"></i>
                                            Show Details
                                        </a>
                                    </span>

                                </div>
                            </div>
                            <div>
                                <table class="table table-fixed bg-slate-50 table-bordered">
                                    <tbody>
                                        @foreach ($order->orderTransactions as $product)
                                            <tr>
                                                <td class="text-center truncate  whitespace-nowrap  ">
                                                    {{ $product->product_name }}
                                                </td>
                                                <td class="text-center  whitespace-nowrap ">
                                                    {{ $product->quantity }} pcs
                                                </td>
                                                <td class="text-center  whitespace-nowrap ">
                                                    ₱{{ number_format($product->price,2) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3" class="text-right">
                                                @php
                                                    $total = 0
                                                @endphp
                                                @foreach ($order->orderTransactions as $product)
                                                    <?php $total += $product->quantity * $product->price ?>
                                                @endforeach
                                                Total: ₱{{number_format($total,2)}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @empty
                            <tr>
                                <td colspan="5" class="font-medium">No Orders Found</td>
                            </tr>
                     @endforelse
                </div>
            </div>
        </div>
        <!-- END: Display Information -->
    </div>
</div>
<!-- End: Canccelation Body -->
@endsection

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
                    @if($orderdetails->status == "Rejected" || $orderdetails->status == "Cancelled")
                        <div class="btn btn-rounded btn-danger-soft w-24 mr-1 mb-2">{{ $orderdetails->status }}</div>
                    @elseif($orderdetails->status == "Completed")
                        <div class="btn btn-rounded btn-success-soft w-full text-xs	">{{ $orderdetails->status }}</div>
                    @else
                        <div class="ml-2 px-2 py-2 bg-slate-200 text-slate-600  text-xs rounded-md">{{ $orderdetails->status }}</div>
                    @endif
                </div>
            </div>
            <div class="p-5">

                <div class="overflow-x-auto">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <th class="whitespace-nowrap">Product Name</th>
                            <th class="whitespace-nowrap text-center">Price</th>
                            <th class="whitespace-nowrap text-center">Quantity</th>
                            @if($orderdetails->status == "Completed")
                                <th class="whitespace-nowrap text-center">Action</th>
                            @endif
                            </thead>
                        <tbody>
                            @foreach ($orderdetails->orderTransactions as $order)
                                <tr>
                                    <td class="whitespace-nowrap"> <a href="{{ Route('productshow',$order->product_id) }}">{{ $order->product_name }}</a></td>
                                    <td class="whitespace-nowrap text-center">₱{{ number_format($order->price,2) }}</td>
                                    <td class="whitespace-nowrap text-center">{{ number_format($order->quantity) }}</td>
                                    @if($orderdetails->status == "Completed")
                                        @if($order->reviewTransactions->count()  == 0)
                                            <td class="whitespace-nowrap text-center text-success">
                                                <a onclick="setProductToReview('{{$order->product_name}}', {{$order->id}})" href="javascript:;">
                                                    <i class="fa-solid fa-eye w-4 h-4 mr-1"></i> Make a review
                                                </a>
                                            </td>
                                        @else
                                            <td class="text-center whitespace-nowrap">Reviewed</td>
                                        @endif

                                    @endif
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
                Placed On: {{ $orderdetails->created_at->toFormattedDateString() }}
            </div>
            <div>
                Mode of Payment: {{ $orderdetails->mode_of_payment }}
            </div>
            @if($orderdetails->payment_id != null)
            <div>
                Payment ID: {{ $orderdetails->payment_id }}
            </div>
            @endif
        </div>
        <div class="flex justify-between flex-col  md:flex-col lg:flex-row  2xl:flex-row  sm:flex-col gap-5 ">
            <div class="intro-y box p-5 mt-5 w-full">
                <div class="font-medium">Shipping Information</div>
                <div class="w-full border-t border-slate-200/60 mt-1 mb-2"></div>
                <div>
                    Receiver: {{ $orderdetails->received_by }}
                </div>
                <div>
                    Phone Number: {{ $orderdetails->phone_number }}
                </div>
                <div>
                    Notes: {{ $orderdetails->notes }}
                </div>
                <div>
                    Address {{ $orderdetails->house }}
                </div>
                <div>
                    Postal Code: {{ $orderdetails->province }}~{{ $orderdetails->city }}~{{ $orderdetails->barangay }}
                </div>
            </div>
            <div class="intro-y box p-5 mt-5 w-full">
                <div class="font-medium">Total Summary</div>
                <div class="w-full border-t border-slate-200/60 mt-1 mb-2"></div>

                <div class="flex justify-between">
                    <div>Subtotal</div>
                    <div>₱
                        @php
                            $total = 0
                        @endphp
                        @foreach ($orderdetails->orderTransactions as $item)
                            <?php $total += $item->quantity * $item->price ?>
                        @endforeach
                        {{ number_format($total,2) }}
                    </div>
                </div>
                <div class="flex justify-between">
                    <div>Shipping Fee</div>
                    <div>₱{{ number_format($orderdetails->shippingfee) }}</div>
                </div>
                <div class="w-full border-t border-slate-200/60 mt-1 mb-2"></div>
                <div class="flex justify-between">
                    <div>Total</div>
                    <div>₱{{ number_format($total+$orderdetails->shippingfee,2) }}</div>
                </div>
            </div>
        </div>

        @if($orderdetails->status == "Rejected")
            <div class="box intro-y mt-5 p-5">
                Rejected Order Reason: {{ $orderdetails->rejected_reason }}
            </div>
        @endif
        @livewire('customer.order.cancel-order',['orderdetails' => $orderdetails])
        <livewire:customer.order.cancel-order-modal/>

        <!-- Begin: Product Review Modal -->
        <livewire:customer.review.product-review-form :orderDetails="$orderdetails" >
        <!-- End: Product Review Modal -->

        @if($orderdetails->status == "Completed" && $daysDifference <= 7)
            <div class="intro-x flex justify-end">
                <a  onclick="RequestRefund('{{ $orderdetails->id }}')" class="btn btn-primary mt-5 ">Request For Refund</a>
            </div>
        @endif
        <livewire:customer.order.request-for-refund-modal/>
    </div>
    <!-- BEGIN: Display Information -->
</div>
<!-- End: Order Details Body -->
@endsection
@push('scripts')
<script>
     //Show Edit Form Modal
     const cancelOrderModal = tailwind.Modal.getInstance(document.querySelector("#cancel-order-modal"));
    window.addEventListener('openCancelModal',event => {
        cancelOrderModal.show();
    });
    //Hide Add Form Modal
    window.addEventListener('CloseOrderCancellationModal',event => {
        cancelOrderModal.hide();

    });
    //Closing Modal and Refreshing its value
    const ForceCloseCancelOrderModal = document.getElementById('cancel-order-modal')
    ForceCloseCancelOrderModal.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
    });
    //Reviews
    const reviewModalElement = document.querySelector("#review-product-modal");
    const reviewModal =  tailwind.Modal.getOrCreateInstance(reviewModalElement)
    const setProductToReview = (productName, productId)=>{
        livewire.emit("selectProductToReview", productName, productId);
    }

    window.addEventListener('CloseReviewModal',event => {
        reviewModal.hide()
    });
    window.addEventListener('ShowReviewModal', event => {
        reviewModal.show()
    });
    window.addEventListener('swal:modal',event =>{
        Swal.fire({
            title: event.detail.title,
            icon: event.detail.type
        })
    });
    const requestrefundmodal = tailwind.Modal.getInstance(document.querySelector("#request-refund-modal"));
    const RequestRefund = (orderid)=>{
        livewire.emit("RequestforRefund",orderid);
    }
    window.addEventListener('closeRequestForRefundModal',event => {
        requestrefundmodal.hide()
    });
    window.addEventListener('openRequestForRefundModal', event => {
        requestrefundmodal.show()
    });

</script>
@endpush

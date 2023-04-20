<div>
    <div class="intro-y grid grid-cols-12 gap-5 mt-5">
        <div class="col-span-12 lg:col-span-4 2xl:col-span-3">
            <div class="box p-5 rounded-md">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium text-base truncate">Transaction Details</div>
                </div>
                <div class="flex items-center">
                    <i class="fa-regular fa-rectangle-list text-slate-500 mr-2"></i>
                    Order ID:
                    <div class="underline decoration-dotted ml-1">#{{ $orderdetails->id }}</div>
                </div>
                <div class="flex items-center mt-3">
                    <i class="fa-regular fa-calendar  text-slate-500 mr-2"></i>
                    Purchase Date: {{$orderdetails->created_at->toFormattedDateString() }}
                </div>
                <div class="flex items-center mt-3">
                    <i class="fa-solid fa-timeline text-slate-500 mr-2"></i>
                    Transaction Status:
                    @if($orderdetails->status == "Completed" || $orderdetails->status == "Delivered")
                        <span class="bg-success/20 text-success rounded px-2 ml-1">{{ $orderdetails->status }}</span>
                    @else
                        <span class="rounded px-2 ml-1">{{  $orderdetails->status}}</span>
                    @endif
                    </div>
                </div>
            <div class="box p-5 rounded-md mt-5">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium text-base truncate">Buyer Details</div>
                    <a href="{{ Route('customer.show',$customerinfo->id) }}" class="flex items-center ml-auto text-primary"> <i class="fa-solid fa-eye mr-2"></i> View Details </a>
                </div>
                <div class="flex items-center">
                    <i class="fa-regular fa-user text-slate mr-2"></i> Name:
                    <a href="{{ Route('customer.show',$customerinfo->id) }}" class="underline decoration-dotted ml-1">
                        {{ $orderdetails->customers->name }}
                    </a>
                </div>
                <div class="flex items-center mt-3">
                    <i class="fa-solid fa-mobile-screen-button text-slate mr-2"></i> Phone Number:
                     {{ $customerinfo->phone_number }}
                </div>
                <div class="flex items-center mt-3">
                    <i class="fa-regular fa-envelope text-slate mr-2"></i> Email:
                    {{ $customerinfo->email }}
                </div>
            </div>
            <div class="box p-5 rounded-md mt-5">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium text-base truncate">Payment Details</div>
                </div>
                <div class="flex items-center">
                    <i class="fa-regular fa-credit-card text-slate mr-2"></i> Payment Method:
                    <div class="ml-auto">{{ $orderdetails->mode_of_payment }}</div>
                </div>
                @if($orderdetails->payment_id != null)
                    <div class="flex items-center mt-3">
                        <i class="fa-regular fa-id-badge text-slate mr-2"></i> Payment ID:
                        <div class="ml-auto">{{ $orderdetails->payment_id }}</div>
                    </div>
                @endif
                <div class="flex items-center mt-3">
                    <i class="fa-solid fa-tag text-slate mr-2"></i>Total Price:
                    <div class="ml-auto">₱
                        @php
                            $total = 0
                        @endphp
                        @foreach ($orderdetails->orderTransactions as $item)
                            <?php $total += $item->quantity * $item->price ?>
                        @endforeach
                        {{ number_format($total,2) }}
                    </div>
                </div>
                <div class="flex items-center mt-3">
                   <i class="fa-solid fa-truck-fast text-slate mr-2"></i> Shipping Fee:
                    <div class="ml-auto">₱{{ number_format($orderdetails->shippingfee,2) }}</div>
                </div>

                <div class="flex items-center border-t border-slate-200/60 dark:border-darkmode-400 pt-5 mt-5 font-medium">
                    <i class="fa-solid fa-cash-register text-slate mr-2"></i> Grand Total:
                    <div class="ml-auto">₱{{ number_format($total+$orderdetails->shippingfee,2) }}</div>
                </div>
            </div>
            <div class="box p-5 rounded-md mt-5">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium text-base truncate">Shipping Information</div>
                </div>
                <div class="flex items-center">
                    <i class="fa-solid fa-person-chalkboard text-slate mr-2"></i>
                    Received By: {{ $orderdetails->received_by }}
                </div>
                <div class="flex items-center mt-3">
                    <i class="fa-solid fa-phone text-slate mr-2"></i>
                    Receiver Phone Number: {{ $orderdetails->phone_number }}
                </div>
                <div class="flex items-center mt-3">
                    <i class="fa-regular fa-address-book text-slate mr-2"></i>
                    Receiver Address: {{ $orderdetails->house }}
                </div>
                <div class="flex items-center mt-3">
                    <i class="fa-solid fa-location-dot text-slate mr-2"></i>
                    Postal Code: {{ $orderdetails->province }}~{{ $orderdetails->city }}~{{ $orderdetails->barangay }}
                </div>
                <div class="flex items-center mt-3">
                    <i class="fa-regular fa-note-sticky text-slate mr-2"></i>
                    Notes: {{ $orderdetails->notes }}
                </div>

            </div>
        </div>
        <div class="col-span-12 lg:col-span-7 2xl:col-span-9">
            <div class="box p-5 rounded-md">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium text-base truncate">Order Details</div>
                    @if($orderdetails->order_notes  == null)
                        @livewire('admin.transaction.order-notes-form',['order' => $orderdetails])
                        <livewire:admin.transaction.order-note-modal/>
                    @endif
                </div>
                <div class="overflow-auto lg:overflow-visible -mt-3">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap !py-5">Product Name</th>
                                <th class="whitespace-nowrap text-right">Unit Price</th>
                                <th class="whitespace-nowrap text-right">Qty</th>
                                <th class="whitespace-nowrap text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td class="whitespace-nowrap ml-4">
                               {{ $product->product_name }}
                                </td>
                                <td class="text-right">₱{{ number_format($product->price,2) }}</td>
                                <td class="text-right">{{ number_format($product->quantity) }}</td>
                                <td class="text-right">₱{{ number_format($product->quantity * $product->price,2) }}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Begin: Rejected Reason -->
            @if($orderdetails->rejected_reason  != null)
                <div class="box p-5 rounded-md mt-5">
                    <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                        <div class="font-medium text-base truncate">Rejected Order Reason:</div>
                    </div>
                    <div class="overflow-auto lg:overflow-visible -mt-3">
                        {{ $orderdetails->rejected_reason }}
                    </div>
                </div>
            @endif
            <!-- End: Rejected Reason -->

            <!-- Begin: Notes -->
            @if($orderdetails->order_notes  != null)
                <div class="box p-5 rounded-md mt-5">
                    <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                        <div class="font-medium text-base truncate">Notes:</div>
                        @livewire('form.edit-order-notes-form',['order' => $orderdetails])
                    </div>
                    <div class="overflow-auto lg:overflow-visible -mt-3">
                        {{ $orderdetails->order_notes }}
                    </div>
                </div>
            @endif
            <!-- End: Notes -->

            <!-- Begin: Cancellation In-Development -->
            @if($orderdetails->cancellation_reason  != null)
                <div class="box p-5 rounded-md mt-5">
                    <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                        <div class="font-medium text-base truncate">Cancel Reason of Customer:</div>
                        @if($orderdetails->cancellation_reason  != null)
                        <a href="" class="flex items-center ml-auto text-primary">
                            <i data-lucide="plus" class="w-4 h-4 mr-2"></i> Edit
                        </a>
                        @endif
                    </div>
                    <div class="overflow-auto lg:overflow-visible -mt-3">
                        Main Reason:{{ $orderdetails->cancellation_reason->name }}
                    </div>
                    <div>
                        Detailed Reason: {{ $orderdetails->cancellation_details }}
                    </div>
                </div>
            @endif
            <!-- End: Cancellation -->

            @if($orderdetails->status == "Pending for Approval")
              <livewire:admin.transaction.order-approved-form/>

                @livewire('admin.transaction.order-approval',['order' => $orderdetails])

            @elseif($orderdetails->status == "Processing")
                <div class="mt-5 intro-y flex justify-end gap-2">
                    <a onclick="setOrderToCancel()" class="btn btn-danger">
                        Reject
                    </a>
                    <a onclick="setOrderToPacked('{{ $orderdetails->id }}')"  href="javascript:;" class="btn btn-primary">
                        Set Status To Packed and Ready to Ship
                    </a>
                </div>
            @elseif($orderdetails->status == "Packed")
                <div class="mt-5 intro-y flex justify-end gap-2">
                    <a onclick="setOrderToCancel()" class="btn btn-danger">
                        Reject
                    </a>
                    <a onclick="setOrderOutForDelivery('{{ $orderdetails->id }}')"  href="javascript:;" class="btn btn-primary">
                        Set Status To Out for Delivery
                    </a>
                </div>
            @elseif($orderdetails->status == "Out For Delivery")
                <div class="mt-5 intro-y flex justify-end gap-2">
                    <a onclick="setOrderToCancel()" class="btn btn-danger" href="javascript:;">
                        Reject
                    </a>
                    <a onclick="setOrderToCompleted('{{ $orderdetails->id }}')"  href="javascript:;" class="btn btn-primary">
                        Set Status To Completed
                    </a>
                </div>
            @endif
            <livewire:admin.transaction.set-status-to-packed/>
            <livewire:admin.transaction.order-out-for-delivery-modal/>
            <livewire:admin.transaction.order-completed-modal/>

            <livewire:admin.transaction.order-reject-form/>


        </div>
    </div>

    <div id="success-notification-content" class="toastify-content hidden flex non-sticky-notification-content">
        <i class="fa-regular fa-circle-check fa-3x text-success mx-auto"></i>
        <div class="ml-4 mr-4">
            <div class="font-medium" id="title"></div>
            <div class="text-slate-500 mt-1" id="message"></div>
         </div>
    </div>
    @push('scripts')
        <script>
            //const cancelOrderModal = document.querySelector('');
            const setOrderToPackedModal = tailwind.Modal.getInstance(document.querySelector("#set-status-to-packed-modal"));

          ///  const setOrderToPackedModal = document.querySelector('#set-status-to-packed-modal');
            const setOrderToPacked = (orderid)=>{
                livewire.emit("SetStatusToPacked", orderid,);
            }
            const setOrderToCancel = (orderid)=>{
                livewire.emit("getModelRejectId", orderid,);

            }
            window.addEventListener('HideSetOrderToPackedModal',event => {
                setOrderToPackedModal.hide()
            });
            window.addEventListener('ShowSetOrderToPackedModal', event => {
                setOrderToPackedModal.show()
            });

            const setOrderToOutForDeliveryModal = tailwind.Modal.getInstance(document.querySelector("#set-status-to-out-for-delivery-modal"));

            const setOrderOutForDelivery = (orderid)=>{
                livewire.emit("SetStatusToOutForDelivery",orderid);
            }
            window.addEventListener('ShowOutForDeliveryModal',event => {
                setOrderToOutForDeliveryModal.show()
            });
            window.addEventListener('HideOutForDeliveryModal', event => {
                setOrderToOutForDeliveryModal.hide()
            });

            const setOrderCompleted = tailwind.Modal.getInstance(document.querySelector("#set-status-completed-modal"));

            const setOrderToCompleted = (orderid) => {
                livewire.emit("SetStatusToCompleted",orderid);
            }

            window.addEventListener('ShowCompletedModal',event => {
                setOrderCompleted.show()
            });

            window.addEventListener('HideCompletedModal', event => {
                setOrderCompleted.hide()
            });
        </script>
    @endpush
</div>

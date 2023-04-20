@extends('admin.layout.admin')
@section('content')
@section('title', 'Order')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        <a href="{{ url()->previous() }}" class="mr-2 btn">←</a> Transaction Details
    </h2>
</div>
<!-- BEGIN: Transaction Details -->
@livewire('admin.transaction.order-details',['orderdetails' => $orderdetails])



<!-- END: Transaction Details -->
@endsection
@push('scripts')
    <script>
    //SuccessAlert
    window.addEventListener('SuccessAlert',event => {
        let id = (Math.random() + 1).toString(36).substring(7);
        Toastify({
            node: $("#success-notification-content") .clone() .removeClass("hidden")[0],
            duration: 7000,
            className: `toast-${id}`,
            newWindow: false,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true, }).showToast();

            const toast = document.querySelector(`.toast-${id}`)
            toast.querySelector("#title").innerText = event.detail.title
            toast.querySelector("#message").innerText = event.detail.name
        });
    //Invalid Alert
    window.addEventListener('InvalidAlert',event => {
        let id = (Math.random() + 1).toString(36).substring(7);
        Toastify({
            node: $("#invalid-success-notification-content") .clone() .removeClass("hidden")[0],
            duration: 7000,
            newWindow: true,
            className: `toast-${id}`,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true, }).showToast();

            const toast = document.querySelector(`.toast-${id}`)
                toast.querySelector("#title").innerText = event.detail.title
                toast.querySelector("#message").innerText = event.detail.name
    });
    const ApprovedModal = tailwind.Modal.getInstance(document.querySelector("#order-approved-modal"));
    window.addEventListener('OpenApprovedModal',event => {
        ApprovedModal.show();
    });
    //Hide Form Modal
    window.addEventListener('closeApprovedModal',event => {
        ApprovedModal.hide();
    });
    //Closing Modal and Refreshing its value
    const ApprovedModalEl = document.getElementById('order-approved-modal')
    ApprovedModalEl.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
    })
      //Delete Modal
      const RejectModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#order-reject-modal"));
    //Show Delete Modal
    window.addEventListener('openRejectModal',event => {
        RejectModal.show();
    });
    //Hide Delete Modal
    window.addEventListener('closeRejectModal',event => {
        RejectModal.hide();
    });
    //Hide Modal and Refresh its value
    const DeleteModal = document.getElementById('order-reject-modal')
    DeleteModal.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
    })
    //Open Change Order Status Modal
    const ChangeOrderStatusModal = tailwind.Modal.getInstance(document.querySelector("#change-order-status-modal"));
    window.addEventListener('openChangeOrderStatusModal',event=>{
        ChangeOrderStatusModal.show();
    });
    //Hide Change Order Status Modal
    window.addEventListener('CloseChangeOrderStatusModal',event=>{
        ChangeOrderStatusModal.hide();
    });
     //Hide Modal and Refresh its value
     const RefreshChangeOrderStatusModal = document.getElementById('change-order-status-modal')
     RefreshChangeOrderStatusModal.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
    });
    //Show Order Notes Modal
    const OrderNotesModal = tailwind.Modal.getInstance(document.querySelector("#order-notes-modal"));
    window.addEventListener('openOrderNotesModal',event=>{
        OrderNotesModal.show();
    });
    //Hide Order Notes Modal
    window.addEventListener('closeOrderNotesModal',event=>{
        OrderNotesModal.hide();
    });
     //Hide Modal and Refresh its value
     const RefreshOrderNotesModal = document.getElementById('order-notes-modal')
     RefreshOrderNotesModal.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
    });

    </script>
@endpush

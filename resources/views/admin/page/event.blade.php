@extends('admin.layout.admin')
@section('content')
@section('title', 'Event')
<!-- Begin: Header -->
<h2 class="intro-y text-lg font-medium mt-10">Event</h2>
<!-- End: Header -->
<!-- Begin: Events Table -->
<livewire:admin.event.event-table/>
<!-- End: Events Table -->
<!-- Begin: Events Form -->
<livewire:admin.event.event-form/>
<!-- End: Events Form -->
<!-- Begin: Edit Event Form -->
<livewire:admin.event.event-edit-form/>
<!-- End: Edit Event Form -->
<!-- Begin: Delete Event Modal -->
<livewire:admin.event.event-delete/>
<!-- End: Delete Event Modal-->
<!-- Begin: Unset Score Event Modal -->
<livewire:admin.event.event-unset-score/>
<!-- End: Unset Score Event Modal -->
<!-- Begin: View Score Event Modal -->
<livewire:admin.event.event-view-score/>
<!-- End: View Score Event Modal -->
<!-- Begin: Success Notification -->
<div id="success-notification-content" class="toastify-content hidden flex non-sticky-notification-content">
    <i class="fa-regular fa-circle-check fa-3x text-success mx-auto"></i>
    <div class="ml-4 mr-4">
        <div class="font-medium" id="title"></div>
        <div class="text-slate-500 mt-1" id="message"></div>
     </div>
</div>
<!-- End: Success Notification -->
<!-- Begin: Invalid Notification -->
<div id="invalid-success-notification-content" class="toastify-content hidden flex non-sticky-notification-content">
    <i class="fa-regular fa-circle-xmark fa-3x text-danger mx-auto"></i>
    <div class="ml-4 mr-4">
        <div class="font-medium" id="title"></div>
        <div class="text-slate-500 mt-1" id="message"></div>
     </div>
</div>
<!-- End: Invalid Notification -->

@endsection
@push('scripts')
<script>
    //Begin: Add Event Modal
    const addItemModal = tailwind.Modal.getInstance(document.querySelector("#add-item-modal"));
    window.addEventListener('CloseAddItemModal',event => {
        addItemModal.hide();
    });
    //Closing Modal and Refreshing its value
    const ForceCloseaddItemModal = document.getElementById('add-item-modal')
    ForceCloseaddItemModal.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
    });
    //End: Add Event Modal
    //Begin: Edit Event Modal
    const editItemModal = tailwind.Modal.getInstance(document.querySelector("#edit-item-modal"));
    window.addEventListener('OpenEditModal',event => {
        editItemModal.show();
    });
    //Hide Add Form Modal
    window.addEventListener('closeEditModal',event => {
        editItemModal.hide();

    });
    //Closing Modal and Refreshing its value
    const ForceCloseEditItemModal = document.getElementById('edit-item-modal')
    ForceCloseEditItemModal.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseEditModal');
    });
    //End: Edit Event Modal
    //Begin: Delete Event Modal
    const EventDeleteModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#delete-confirmation-modal"));
    //Show Delete Modal
    window.addEventListener('openDeleteModal',event => {
        EventDeleteModal.show();
    });
    //Hide Delete Modal
    window.addEventListener('CloseDeleteModal',event => {
        EventDeleteModal.hide();
    });
    //Hide Modal and Refresh its value
    const DeleteModal = document.getElementById('delete-confirmation-modal')
    DeleteModal.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
    })
    //End: Delete Event Modal
    //Begin: Unset Score Modal
    const EventUnsetModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#unset-confirmation-modal"));
    //Show Delete Modal
    window.addEventListener('openUnsetModal',event => {
        EventUnsetModal.show();
    });
    //Hide Delete Modal
    window.addEventListener('CloseUnsetModal',event => {
        EventUnsetModal.hide();
    });
    //Hide Modal and Refresh its value
    const UnsetModal = document.getElementById('unset-confirmation-modal')
    UnsetModal.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
    })
    //End: Unset Score Modal
    //Begin: View Score Modal
    const EventViewScoreModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#view-scores-modal"));
    //Show View Score Modal
    window.addEventListener('openViewScoreModal',event => {
        EventViewScoreModal.show();
    });
    //Hide View Score Modal
    window.addEventListener('closeViewScoreModal',event => {
        EventViewScoreModal.hide();
    });
    //Hide Modal and Refresh its value
    const ViewModal = document.getElementById('view-scores-modal')
    UnsetModal.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
    })
    //End: View Score Modal
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
</script>
@endpush

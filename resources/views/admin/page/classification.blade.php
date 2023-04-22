@extends('admin.layout.admin')
@section('content')
@section('title', 'Points')
<!-- Begin: Header -->
<h2 class="intro-y text-lg font-medium mt-10">Pointing Classification</h2>
<!-- End: Header -->

<!-- Begin: Classification Table -->
<livewire:admin.classification.classification-table/>
<!-- End: Classification Table -->
<!--Begin: Classification Form -->
<livewire:admin.classification.classification-form  />
<!--End: Classification Form -->
<!-- Begin: Edit Classification Form -->
<livewire:admin.classification.classification-edit-form/>
<!-- End: Edit Classification Form -->
<!-- Begin: Delete Classification Modal -->
<livewire:admin.classification.classification-delete/>
<!-- End: Delete Event Modal-->


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
    //Begin: Add Classification Modal
    const addItemModal = tailwind.Modal.getInstance(document.querySelector("#add-item-modal"));
    window.addEventListener('CloseAddItemModal',event => {
        addItemModal.hide();
    });
    //Closing Modal and Refreshing its value
    const ForceCloseaddItemModal = document.getElementById('add-item-modal')
    ForceCloseaddItemModal.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
    });
    //End: Add Classification Modal
    //Begin: Edit Classification Modal
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
    //End: Edit Classification Modal
    //Begin: Delete Classification Modal
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
    //End: Delete Classification Modal
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

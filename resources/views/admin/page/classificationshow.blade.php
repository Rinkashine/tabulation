@extends('admin.layout.admin')
@section('content')
@section('title', 'Points')
<!-- Begin: Header -->
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        <a href="{{ url()->previous() }}" class="mr-2 btn">←</a> {{ $classification->name }} - Pointing System

    </h2>
</div>

<!-- End: Header -->
<!-- Begin: Classification Show Points Table -->
@livewire('admin.classification.classfication-points-table',['classification' => $classification])
<!-- End: Classification Show Points Table -->
<!-- Begin: Classification Show Points Form -->
@livewire('admin.classification.classfication-points-form',['classification_id' => $classification->id])
<!-- End: Classification Show Points Form -->
<!-- Begin: Classification Show Points Delete -->
<livewire:admin.classification.classfication-points-delete/>
<!-- End: Classification Show Points Delete -->
<!-- Begin: Classification Show Points Edit Form -->
<livewire:admin.classification.classfication-points-edit-form/>
<!-- End: Classification Show Points Edit Form -->

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
    //Begin Add Position Modal
    const addItemModal = tailwind.Modal.getInstance(document.querySelector("#add-item-modal"));
    window.addEventListener('CloseAddItemModal',event => {
        addItemModal.hide();
    });
    //Closing Modal and Refreshing its value
    const ForceCloseaddItemModal = document.getElementById('add-item-modal')
    ForceCloseaddItemModal.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
    });
    //End: Add Position Modal
    //Begin: Edit Position Modal
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
    //End: Edit Position Modal
    //Begin: Delete Position
    const EventDeleteModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#delete-confirmation-modal"));
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
    //End: Delete Position
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

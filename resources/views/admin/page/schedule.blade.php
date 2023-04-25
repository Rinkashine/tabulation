@extends('admin.layout.admin')
@section('content')
@section('title', 'Schedule')

<!-- Begin: Schedule Table -->
<livewire:admin.schedule.schedule-table/>
<!-- End: Schedule Table -->
<!-- Begin: Schedule Form Modal -->
<livewire:admin.schedule.schedule-form/>
<!--End: Schedule Form Modal -->
<!-- Begin: Edit Schedule Form -->
<livewire:admin.schedule.schedule-edit-form/>
<!-- End: Edit Schedule Form -->
<!-- Begin: Change Photo Schedule Form -->
<livewire:admin.schedule.schedule-change-photo-form/>
<!-- End: Change Photo Schedule Form -->
<!-- Begin: Delete  Schedule Form -->
<livewire:admin.schedule.schedule-delete/>
<!-- End: Delete  Schedule Form -->

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
    const addItemModal = tailwind.Modal.getInstance(document.querySelector("#add-item-modal"));
    //Hide Add Form Modal
    window.addEventListener('CloseAddItemModal',event => {
        addItemModal.hide();
    });
      //Closing Modal and Refreshing its value
      const ForceCloseaddItemModal = document.getElementById('add-item-modal')
    ForceCloseaddItemModal.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
    });
    //Begin: Change Photo Modal
    const ChangePhotoModal = tailwind.Modal.getInstance(document.querySelector("#change-item-modal"));
    window.addEventListener('openChangePhotoModal',event => {
        ChangePhotoModal.show();
   });

   window.addEventListener('closeChangePhotoModal',event => {
        ChangePhotoModal.hide();
    });
   const ForceCloseChangePhotoModal = document.getElementById('change-item-modal')
    ForceCloseChangePhotoModal.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceClosePhotoModal');
    });
    //End: Change Photo Modal
    //Begin: Edit Name Modal
   const editItemModal = tailwind.Modal.getInstance(document.querySelector("#edit-item-modal"));
    window.addEventListener('OpenEditModal',event => {
      editItemModal.show();
       console.log('test');
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
    //End: Edit Name Modal

    //Begin: Delete Team Modal
    const BrandDeleteModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#delete-confirmation-modal"));
    //Show Delete Modal
    window.addEventListener('openDeleteModal',event => {
        BrandDeleteModal.show();
    });
    //Hide Delete Modal
    window.addEventListener('CloseDeleteModal',event => {
        BrandDeleteModal.hide();
    });
    //Hide Modal and Refresh its value
    const DeleteModal = document.getElementById('delete-confirmation-modal')
    DeleteModal.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
    })
   //Delete Modal

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

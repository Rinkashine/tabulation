@extends('admin.layout.admin')
@section('content')
@section('title', 'Team')
<!-- Begin: Header -->
<h2 class="intro-y text-lg font-medium mt-10">List of Teams</h2>
<!-- End: Header -->


<!-- Begin: Brand Table -->
<livewire:admin.team.team-table/>
<!-- End: Brand Table -->
<!-- Begin: Change Photo Form Modal -->
<livewire:admin.team.team-change-photo-form/>
<!-- End: Change Photo Form Modal -->
<!-- Begin: Team Form Modal -->
<livewire:admin.team.team-form/>
<!--End: Team Form Modal -->
<!-- Begin: Team Edit Name Modal -->
<livewire:admin.team.team-edit-form/>
<!-- End: Team Edit Name Modal -->
<!-- Begin: Delete Team -->
<livewire:admin.team.team-delete/>
<!-- End: Delete Team -->


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
   //Delete Modal
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
    //End: Delete Team Modal

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

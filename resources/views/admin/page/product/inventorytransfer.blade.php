@extends('admin.layout.admin')
@section('content')
@section('title', 'Inventory Transfer')


<!-- Begin: Inventory Transfer  -->
<livewire:admin.transfer.inventory-transfer-table/>
<!-- End: Inventory Transfer  -->

@endsection

@push('scripts')
@endpush

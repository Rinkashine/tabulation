@extends('customer.layout.base')
@section('content')
@section('title', 'Profile Information')
<!-- Begin: Header -->
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
            Welcome to Go Dental!
    </h2>
</div>
<!-- End: Header -->
<!-- Begin: Returns Body -->
<div class="grid grid-cols-12 gap-6">
    <!-- BEGIN: Profile Menu -->
    @include('customer.component.side-profile')
    <!-- END: Profile Menu -->
    <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
        <!-- BEGIN: Display Information -->
        <div class="intro-y box lg:mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">
                    My Returns
                </h2>
            </div>
            <div class="p-5">
                <div class="overflow-x-auto">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th class="whitespace-nowrap">Order ID</th>
                                <th class="whitespace-nowrap text-center">Product Name</th>
                                <th class="whitespace-nowrap text-center">Quantity</th>
                                <th class="whitespace-nowrap text-center">Returned on</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($returns as $item)
                                <tr>
                                    <td class="whitespace-nowrap">Brush</td>
                                    <td class="whitespace-nowrap text-center">Key</td>
                                    <td class="whitespace-nowrap text-center">₱100.00</td>
                                    <td class="whitespace-nowrap text-center">2</td>
                                    <td class="whitespace-nowrap text-center text-success">Received</td>
                                    <td class="whitespace-nowrap text-center"><i class="fa-solid fa-eye w-4 h-4 mr-1"></i> Show</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="whitespace-nowrap" colspan="4"> No Returns Found </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END: Display Information -->
    </div>
</div>
<!-- End: Returns Body -->
@endsection
@push('scripts')
<script>
</script>
@endpush

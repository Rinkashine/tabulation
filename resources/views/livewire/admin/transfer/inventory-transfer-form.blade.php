<div>
    <form wire:submit.prevent="StoreTransferData">
        <div class="grid grid-cols-12 gap-x-6 mt-5 pb-20">
            <div class="intro-y col-span-12">
                <!-- Begin: Display All Errors-->
                @if ($errors->any())
                <div class="absolute top-0 right-0 sm:left-1/2 sm:transform sm:-translate-x-1/2 sm:-translate-y-1/2 z-50 sm:w-1/3 alert alert-danger show mb-2" role="alert">
                    <div class="flex items-center">
                        <div class="font-medium sm:text-lg mr-1">Whoops! Something Went Wrong</div>
                        <div class="text-xs bg-white px-1 rounded-md text-slate-700 ml-auto">Error</div>
                    </div>
                    <div class="mt-3">
                        @foreach ($errors->all() as $error)
                        <div>{{$error}}</div>
                        @endforeach
                    </div>
                </div>
                @endif
                <!-- End: Display All Errors -->
                <!-- Begin: Supplier Information -->
                <div class="box p-5">
                    <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                        <div class="flex justify-between items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                            <div class="font-medium text-base">
                                Supplier
                            </div>
                            @if($toggleinfo)
                                <div class="dropdown">
                                    <button type="button" class="dropdown-toggle underline text-blue-400" aria-expanded="false" data-tw-toggle="dropdown">
                                        View Supplier Info
                                    </button>
                                    <div class="dropdown-menu w-40">
                                        <ul class="dropdown-content">
                                            <li>
                                                <div class="dropdown-header">Address</div>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li>
                                                @foreach ($supplierinfo as $info)
                                                    {{ $info->address }}
                                                @endforeach
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li>
                                                <div class="dropdown-header">Contact</div>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                                @foreach ($supplierinfo as $info)
                                                    <li>{{ $info->contact_name }}</li>
                                                    <li>{{ $info->email }}</li>
                                                    <li>{{ $info->contact_number }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                        </div>
                        <div class="mt-5">
                            <!-- Supplier Origin -->
                            <div class="form-inline items-start flex-col mt-5 pt-5 first:mt-0 first:pt-0">
                                <div class="form-label xl:w-64 xl:!mr-10">
                                    <div class="text-left">
                                        <div class="flex items-center">
                                            <div class="font-medium">Supplier Origin</div>
                                            <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full mt-3">
                                    <select wire:model="origin" class="form-select">
                                        <option value="">Select Origin</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End: Supplier Information -->
                <!-- BEGIN: Add Products -->
                <div class="box p-5 mt-5">
                    <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                        <div class="flex justify-between items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                            <div class="font-medium text-base">
                                Add Products
                            </div>
                        </div>
                        <div class="mt-5">
                            <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                <div class="w-full mt-3 xl:mt-0 flex-1">
                                    <div class="intro-x relative">
                                        <input type="search" class="form-control" wire:model="query">
                                        <div class="absolute z-50 h-fit w-full rounded-b-lg bg-white shadow-2xl py-2 px-2 mt-2">
                                            <div wire:loading wire:target="query" class="flex items-center font-medium ">
                                                <div>Searching...</div>
                                            </div>
                                            @if (!empty($query))
                                            <div class="search-result__content">
                                                @if(!empty($products))
                                                    @foreach($products as $product)
                                                    <div class="flex flex-col sm:flex-row w-full  mt-2 border rounded font-medium px-2 py-2 ">
                                                        <div class="2xl:w-full xl:w-full lg:w-full md:w-full text-left" >
                                                            <button wire:click="AddTd({{json_encode($product)}})" type="button" class=" text-left" >
                                                                {{ $product['name']}}
                                                            </button>
                                                        </div>
                                                        <div class="w-2/4 sm:w-full sm:ml-5 text:left sm:text-center">
                                                            <div class="ml-auto truncate text-slate-500 text-xs">SKU {{ $product['SKU'] }}</div>
                                                        </div>
                                                        <div class="w-1/4 sm:w-full sm:ml-5 text:left sm:text-right">
                                                            <div class="ml-auto  text-slate-500 text-xs">Current Stock: {{ $product['stock'] }}</div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                @else
                                                    <div class="flex items-center mt-2 font-medium">No Results Found</div>
                                                @endif
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(!empty($selectedProducts))
                            <div class="overflow-x-auto mt-8">
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="whitespace-nowrap">Product Name</th>
                                            <th class="whitespace-nowrap">SKU</th>
                                            <th class="whitespace-nowrap">Quantity</th>
                                            <th class="whitespace-nowrap">Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($selectedProducts as $key=>$selectedproduct)
                                            <tr>
                                                <td>{{ $selectedproduct['name'] }}</td>
                                                <td> {{ $selectedproduct['SKU'] }}</td>
                                                <td>
                                                    <input type="number" min="1" oninput="onInput(this,{{ $selectedproduct['id'] }}, {{ $key }})" placeholder="Order Quantity" class="form-control" onkeypress="return event.charCode >= 48">
                                                </td>
                                                <td> <button type="button" wire:click="DeleteTd({{ json_encode($selectedproduct)}})">Delete</button> </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>


                 <!-- END: Add Products -->

                 <div class="flex justify-between flex-col  md:flex-col lg:flex-row  2xl:flex-row  sm:flex-col gap-5 ">
                    <div class=" box p-5 mt-5 w-full">
                        <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                            <div class="flex justify-between items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                                <div class="font-medium text-base">
                                    Shipping Details
                                </div>
                            </div>
                            <div class="mt-5">
                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-5">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">Estimated Arrival:</div>
                                                <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full mt-3 xl:mt-0 flex-1">
                                        <input type="date" min="{{ $mindate }}" id="estimatedate" wire:model="shipping" class="form-control" data-single-mode="true">
                                    </div>
                                </div>
                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-5">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">Tracking Number:</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full mt-3 xl:mt-0 flex-1">
                                        <div class="relative w-full mx-auto">
                                            <input type="text" wire:model="tracking" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" box p-5 mt-5 w-full">
                        <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                            <div class="flex justify-between items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                                <div class="font-medium text-base">
                                    Remarks
                                </div>
                            </div>
                            <div class="mt-5">
                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="w-full mt-3 xl:mt-0 flex-1">
                                        <textarea class="form-control" rows="5" wire:model="remarks">{!! $remarks !!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
        <div class="intro-y flex justify-end flex-col md:flex-row gap-2 ">
            <div class="flex justify-end flex-col md:flex-row gap-2 ">
                <button wire:click="Cancel" type="button" class="btn py-3 border-slate-300 dark:border-darkmode-400 text-slate-500 w-full md:w-52">Cancel</button>
                <input type="submit" class="btn py-3 btn-primary w-full md:w-52" value="Save">
            </div>
        </div>
    </form>
    @push('scripts')
    <script>
    document.addEventListener('livewire:load', function () {
        var todayDate = new Date();
        var month = todayDate.getMonth() + 1;
        var year =  todayDate.getUTCFullYear();
        var tdate = todayDate.getDate();
        if(month < 9){
            month = "0" + month;
        }
        if(tdate < 10){
            tdate = "0" + tdate;
        }
        var maxDate = year + "-" + month + "-" + tdate;
        @this.mindate = maxDate;
        livewire.emit("minDate",maxDate)
        document.getElementById("estimatedate").setAttribute("min", maxDate);
    })
    </script>
    @endpush
</div>

<div>
    <div class="intro-y box p-5">
        <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
            <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                <a href="{{Route('report.OrdersByCustomer')}}" class="mr-2 btn">←</a> {{$customer_name}} Bought Products
            </div>

            <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
                <div class="xl:flex sm:mr-auto mt-5" >
                    <div class="sm:flex items-center sm:mr-4">
                        <label class="flex-none xl:w-auto xl:flex-initial mr-2">Sort</label>
                        <select wire:model="sorting"  class="form-select w-full sm:w-32 2xl:w-full mt-2 sm:mt-0 sm:w-auto">
                            <option value="product_name_asc">product Name (A-Z)</option>
                            <option value="product_name_desc">product Name (Z-A)</option>
                            <option value="total_quantity_asc">Order Quantity (Low To High)</option>
                            <option value="total_quantity_desc">Order Quantity (High To Low)</option>
                        </select>
                    </div>

                    <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                        <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Search</label>
                        <input wire:model.lazy="search" type="search" class="form-control sm:w-40 2xl:w-full mt-2 sm:mt-0" placeholder="Search...">
                    </div>
                </div>
                @can('report_export')
                    <div class="mt-5">
                        <a href="{{Route('report.exportCustomerByProductExcel',['name' => $customer_name, 'id'=>$customer_id])}}" class="btn btn-primary"> <i class="fa-solid fa-file-excel mr-1"></i> Export Excel </a>
                    </div>
                @endcan
            </div>
                <!-- Begin: product Table -->
                <div class="overflow-x-auto scrollbar-hidden">
                    <div class="overflow-x-auto">
                        <table class="table table-striped mt-5 table-bordered table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th class="whitespace-nowrap ">product Name</th>
                                    <th class="whitespace-nowrap text-center">Total Ordered Products</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product )
                                    <tr>
                                        <td class="whitespace-nowrap ">{{$product->name}}</td>
                                        <td class="whitespace-nowrap text-center">{{ number_format($product->total_quantity)}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- End: product Table -->
                <!-- Begin: product Pagination -->
                <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center mt-5">
                    <nav class="w-full sm:w-auto sm:mr-auto">
                        {!! $products->onEachSide(1)->links() !!}
                    </nav>
                    <div class="mx-auto text-slate-500">
                        @if($products->count() == 0)
                            Showing 0 to 0 of 0 entries
                        @else
                            Showing {{$products->firstItem()}} to {{$products->lastItem()}} of {{$products->total()}} entries
                        @endif
                    </div>
                    <select wire:model="perPage" class="w-20 form-select box mt-3 sm:mt-0">
                        <option>10</option>
                        <option>25</option>
                        <option>50</option>
                        <option>100</option>
                    </select>
                </div>
                <!-- End: product Pagination -->
            </div>
        </div>
    </div>
    {{-- <div class=" box p-5 mt-5 w-full">
        <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
            <div class="flex justify-between items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                <div class="font-medium text-base">
                    Orders
                </div>
            </div>
            <div class="flex justify-center">
                <div class="w-full" >
                    <canvas id="SalesOrderChart"  ></canvas>
                </div>
            </div>
        </div>
    </div> --}}
{{--
    @push('scripts')
        <script>

        var label =  {{ Js::from($productlabel) }};

        //Begin: Order Chart
        var salesorderdataset =  {{ Js::from($productordersdataset) }};
        const ordertypedata = {
        labels: label,
        datasets: [{
            label: 'Orders',
            data: salesorderdataset,
            backgroundColor: [
                'rgb(30,95,78)',
                'rgb(250,209,44)',
                'rgba(255, 99, 132)',
                'rgba(255, 159, 64)',
                'rgba(255, 205, 86)',
                'rgba(75, 192, 192)',
                'rgba(54, 162, 235)',
                'rgba(153, 102, 255)',
                'rgba(201, 203, 207)'
            ],
            hoverOffset: 4
        }]
        };
        const ordertypeconfig = {
            type: 'bar',
            data: ordertypedata,
            options: {
                scales: {
                y: {
                    beginAtZero: true
                    }
                }
            },
        };

        const SalesOrderChart = new Chart(
            document.getElementById('SalesOrderChart'),
            ordertypeconfig
        );

        window.addEventListener('render-chart',event => {
            SalesOrderChart.config.data.labels = event.detail.label;

            SalesOrderChart.config.data.datasets[0].data = event.detail.orderdataset;

            SalesOrderChart.update();
            });

        //End: Order Chart
        </script>
    @endpush --}}
</div>

<div>
    <div class="intro-y flex justify-between items-center mt-8">
        <div>
            <h2 class="text-lg font-medium mr-auto">
                <a href="{{ Route('report.index') }}" class="mr-2 btn">←</a>Payment By Type
            </h2>
        </div>
        @can('report_export')
            <div>
                <a href="{{Route('report.exportPaymentByType',['startdate'=>$startdate,'enddate'=>$enddate])}}" class="btn btn-primary"> <i class="fa-solid fa-file-excel mr-1"></i> Export Excel </a>
            </div>
        @endcan
    </div>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: Payment Type Chart -->
                <div class="col-span-12 xl:col-span-8 mt-6">
                    <div class=" box mt-5 w-full">
                        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                            <div class="flex flex-col sm:flex-row sm:items-end xl:items-start ">
                                <div class="xl:flex sm:mr-auto" >
                                    <div class="sm:flex items-center sm:mr-4">
                                        <label class="flex-none xl:w-auto xl:flex-initial mr-2">From:</label>
                                        <input type="datetime-local" wire:model.lazy="startdate" class="form-control" max="{{ $enddate }}">
                                    </div>
                                    <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                                        <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">To:</label>
                                        <input type="datetime-local" wire:model.lazy="enddate" class="form-control" min="{{ $startdate }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-5" >
                            <div class="flex justify-center items-center ">
                                <div class="w-1/2 h-1/2" wire:ignore>
                                    <canvas id="PaymentType"  ></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Payment Type Chart -->
                <!-- BEGIN: Payment Type Table -->
                <div class="col-span-12 xl:col-span-4 2xl:mt-5">
                    <div class="intro-y box  mt-12 sm:mt-5">
                        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                            <h2 class="font-medium text-base mr-auto">
                                Values
                            </h2>
                        </div>
                        <div class="p-5">
                            <div class="overflow-x-auto">
                                <table class="table table-bordered">
                                    <thead class="table-dark">
                                        <tr>
                                            <td class="whitespace-nowrap text-center">Mode of Payment</td>
                                            <td class="whitespace-nowrap text-center">Sessions</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($typeofpayment as $data)
                                            <tr>
                                                <td class="whitespace-nowrap text-center">{{ $data->type }}</td>
                                                <td class="whitespace-nowrap text-center">{{ $data->total }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="whitespace-nowrap text-center" colspan="2">No Data Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Payment Type Table -->
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        //Begin: Payment Type Pie Chart
        var paymenttypelabel =  {{ Js::from($paymenttypelabel) }};
        var paymenttypedataset =  {{ Js::from($paymenttypedataset) }};
        const paymenttypedata = {
        labels: paymenttypelabel,
        datasets: [{
            label: 'dataset',
            data: paymenttypedataset,
            backgroundColor: [
            'rgb(30,95,78)',
            'rgb(250,209,44)',
            ],
            hoverOffset: 4
        }]
        };
        const paymenttypeconfig = {
            type: 'pie',
            data: paymenttypedata,
        };

        const PaymentTypeChart = new Chart(
            document.getElementById('PaymentType'),
            paymenttypeconfig
        );
        window.addEventListener('render-chart',event => {
            PaymentTypeChart.config.data.labels = event.detail.label;
            PaymentTypeChart.config.data.datasets[0].data = event.detail.dataset;
            PaymentTypeChart.update()
        });
        //End: Payment Type Pie Chart
    </script>


    @endpush



</div>

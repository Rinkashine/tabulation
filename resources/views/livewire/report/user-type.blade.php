<div>
    <div class="intro-y flex justify-between items-center mt-8">
        <div>
            <h2 class="text-lg font-medium mr-auto">
                <a href="{{ Route('report.index') }}" class="mr-2 btn">←</a>User Type
            </h2>
        </div>
        @can('report_export')
            <div>
                <a href="{{ Route('exportusertypeexcel',['startdate'=>$startdate,'enddate'=>$enddate]) }}" class="btn btn-primary">Export To Excel</a>
            </div>
        @endcan
    </div>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: Most Visited Page -->
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
                                        <input type="datetime-local" wire:model="enddate" class="form-control" min="{{ $startdate }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-5" >
                            <div class="flex justify-center items-center ">
                                <div class="w-1/2 h-1/2" wire:ignore>
                                    <canvas id="UserType"  ></canvas>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- END: Official Store -->
                <!-- BEGIN: Weekly Best Sellers -->
                <div class="col-span-12 xl:col-span-4 2xl:mt-5">
                    <div class="intro-y box  mt-12 sm:mt-5">
                        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                            <h2 class="font-medium text-base mr-auto">
                                User Type Data
                            </h2>
                        </div>
                        <div class="p-5">
                            <div class="overflow-x-auto">
                                <table class="table table-bordered">
                                    <thead class="table-dark">
                                        <tr>
                                            <td class="whitespace-nowrap text-center">Rank</td>
                                            <td class="whitespace-nowrap text-center">Type</td>
                                            <td class="whitespace-nowrap text-center">Sessions</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($usertype as $user)
                                            <tr>
                                                <td class="whitespace-nowrap text-center">{{ $loop->iteration }}</td>
                                                <td class="whitespace-nowrap text-center">{{ $user['type'] }}</td>
                                                <td class="whitespace-nowrap text-center">{{ $user['sessions'] }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="whitespace-nowrap text-center" colspan="3">No Data Found</td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- END: Weekly Best Sellers -->

            </div>
        </div>
    </div>
    @push('scripts')
<script>

    //Begin: User Type Chart
    var usertypelabel =  {{ Js::from($usertypelabel) }};
    var usertypedataset =  {{ Js::from($usertypedataset) }};
    const usertypedata = {
    labels: usertypelabel,
    datasets: [{
        label: 'User Type',
        data: usertypedataset,
        backgroundColor: [
        'rgb(30,95,78)',
        'rgb(250,209,44)',
        ],
        hoverOffset: 4
    }]
    };
    const usertypeconfig = {
        type: 'pie',
        data: usertypedata,
    };

    const UserTypeChart = new Chart(
        document.getElementById('UserType'),
        usertypeconfig
    );

    window.addEventListener('render-chart',event => {
        UserTypeChart.config.data.labels = event.detail.label;
        UserTypeChart.config.data.datasets[0].data = event.detail.dataset;
        UserTypeChart.update()
        });
    //End: User Type Chart

    </script>

@endpush

</div>

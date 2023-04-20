<div>
    <div class="intro-y flex justify-between items-center mt-8">
        <div>
            <h2 class="text-lg font-medium mr-auto">
                <a href="{{ Route('report.index') }}" class="mr-2 btn">←</a>Gender Report
            </h2>
        </div>
        @can('report_export')
            <div>
                <a href="{{ Route('exportGenderExcel') }}" class="btn btn-primary">Export To Excel</a>
            </div>
        @endcan
    </div>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: Main Body Chart -->
                <div class="col-span-12 xl:col-span-8 mt-6">
                    <div class=" box mt-5 w-full">

                        <div class="p-5" >
                            <div class="flex justify-center items-center ">
                                <div class="w-1/2 h-1/2" wire:ignore>
                                    <canvas id="Gender"></canvas>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- END: Main Body Chart -->
                <!-- BEGIN: Table Data -->
                <div class="col-span-12 xl:col-span-4 2xl:mt-5">
                    <div class="intro-y box  mt-12 sm:mt-5">
                        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                            <h2 class="font-medium text-base mr-auto">
                                Gender Report
                            </h2>
                        </div>
                        <div class="p-5">
                            <div class="overflow-x-auto">
                                <table class="table table-bordered">
                                    <thead class="table-dark">
                                        <tr>
                                            <td class="whitespace-nowrap text-center">Gender</td>
                                            <td class="whitespace-nowrap text-center">Total</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($gender as $data)
                                            <tr>
                                                <td class="whitespace-nowrap text-center">{{ $data->gender}}</td>
                                                <td class="whitespace-nowrap text-center">{{ $data->total }}</td>
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
                <!-- END: Table Data -->
            </div>
        </div>
    </div>
@push('scripts')
    <script>
        var genderlabel = {{ Js::from($genderlabel) }};
        var genderdataset =  {{ Js::from($genderdataset) }};
        const data = {
            labels: genderlabel,
            datasets: [{
                label: 'Gender',
                data: genderdataset,
                backgroundColor: [
                'rgb(30,95,78)',
                'rgb(250,209,44)',
                'rgb(246,168,35)'
                ],
                hoverOffset: 4
            }]
        };

        const config = {
            type: 'doughnut',
            data: data,
        };

        const GenderChart = new Chart(
            document.getElementById('Gender'),
            config
        );

    </script>
@endpush
</div>

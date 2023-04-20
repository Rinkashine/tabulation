<div>
    <div class="intro-y flex justify-between items-center mt-8">
        <div>
            <h2 class="text-lg font-medium mr-auto">
                <a href="{{ Route('report.index') }}" class="mr-2 btn">←</a>Account Verification
            </h2>
        </div>
        @can('report_export')
            <div>
                {{-- <a href="{{ Route('exportsalesovertime') }}" class="btn btn-primary">Export To Excel</a> --}}
            </div>
        @endcan
    </div>
    {{-- <div class="intro-y box mt-5 ">
        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <div>
                <div>
                    <h2 class="font-medium text-base mr-auto">
                        Chart
                    </h2>
                </div>
            </div>
        </div>
        <div class="p-5">
            <canvas id="test" height="80px"></canvas>
        </div>
    </div> --}}
    <div class="intro-y box mt-5 ">
        <div class="p-5">
            <div class="overflow-x-auto">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <td class="whitespace-nowrap text-center">Account</td>
                            <td class="whitespace-nowrap text-center">Count</td>
                            <td class="whitespace-nowrap text-center">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="wwhitespace-nowrap text-center">Verified</td>
                            <td class="whitespace-nowrap text-center">{{$verified}}</td>
                            <td class="whitespace-nowrap text-center"><a href="{{ Route('report.VerifiedAccount') }}">View Details</a></td>
                        </tr>
                        <tr>
                            <td class="wwhitespace-nowrap text-center">Non-Verified</td>
                            <td class="whitespace-nowrap text-center">{{$nonverified}} </td>
                            <td class="whitespace-nowrap text-center"><a href="{{ Route('report.NonVerifiedAccount') }}">View Details</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- @push('scripts')
    <script>

        var saleschartlabel = {{ Js::from($saleschartlabel) }}
        var saleschartdataset = {{ Js::from($saleschartdataset) }}
        const data = {
        labels: saleschartlabel,
        datasets: [{
            label: 'Sales',
            data: saleschartdataset,
            backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255, 205, 86, 0.2)',
            'rgb(255, 205, 86)',
            ],
            borderColor: [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
            'rgb(255, 205, 86)',

            ],
            borderWidth: 1
        }]
        };

        const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
            y: {
                beginAtZero: true
            }
            }
        },
        };

        const Sales = new Chart(
            document.getElementById('test'),
            config
        );
        //End: Sales Chart
        document.querySelector("input[type=number]")
      .oninput = e => console.log(new Date(e.target.valueAsNumber, 0, 1))
    </script>

    @endpush --}}



</div>

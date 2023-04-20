<div>
    <div class="intro-y flex justify-between items-center mt-8">
        <div>
            <h2 class="text-lg font-medium mr-auto">
                <a href="{{ Route('report.CancellationOverTime') }}" class="mr-2 btn">←</a>{{$date}} Order Cancellations
            </h2>
        </div>
        @can('report_export')
            <div>
                <a href="{{ Route('report.exportMonthlyCancellation', ['month'=> $month, 'year' => $year, 'startdate'=> $from,'enddate'=> $to]) }}" class="btn btn-primary">Export To Excel</a>
            </div>
        @endcan
    </div>
    <div class="box mt-5 intro-y">
        <div class="p-5">
            <div class="overflow-x-auto">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <td class="whitespace-nowrap text-center">Order ID</td>
                            <td class="whitespace-nowrap text-center">Customer Name</td>
                            <td class="whitespace-nowrap text-center">Cancellation Reason</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cancellations as $cancellation)
                        <tr>
                            <td class="wwhitespace-nowrap text-center"> <a href="{{ Route('orders.show',$cancellation->id) }}">{{ $cancellation->id }}</a></td>
                            <td class="whitespace-nowrap text-center">{{ $cancellation->customer_name }}</td>
                            <td class="whitespace-nowrap text-center">{{ $cancellation->reason_name }}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
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

<div>
    <div class="intro-y flex justify-between items-center mt-8">
        <div>
            <h2 class="text-lg font-medium mr-auto">
                <a href="{{ Route('report.index') }}" class="mr-2 btn">←</a>Customers Over Time
            </h2>
        </div>
        @can('report_export')
            <div>
                <a href="{{ Route('exportCustomerPerMonthEXCEL') }}" class="btn btn-primary">Export To Excel</a>
            </div>
        @endcan
    </div>
    <div class="intro-y box mt-5 ">
        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="font-medium text-base mr-auto">
                Data
            </h2>
        </div>
        <div class="p-5">
            <div class="overflow-x-auto">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <td class="whitespace-nowrap text-center">Year</td>
                            <td class="whitespace-nowrap text-center">Month</td>
                            <td class="whitespace-nowrap text-center">Created Accounts</td>
                            <td class="whitespace-nowrap text-center"></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($monthlysales as $sales)
                        <tr>
                            <td class="wwhitespace-nowrap text-center">{{ $sales->year }}</td>
                            <td class="whitespace-nowrap text-center">{{ $sales->month_name }}</td>
                            <td class="whitespace-nowrap text-center">{{ number_format($sales->total) }}</td>
                            <td class="whitespace-nowrap text-center"><a href="{{ Route('report.ShowCustomerPerMonth', ['month'=>$sales->month_name, 'year' =>$sales->year]) }}">View Details</a></td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

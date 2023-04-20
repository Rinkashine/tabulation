@extends('admin.layout.admin')
@section('content')
@section('title', 'Report')

<div class="intro-y box p-5">
    <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
        <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
            Report
        </div>
        <!-- Begin: Reports Table -->
        <div class="overflow-x-auto scrollbar-hidden">
            <div class="overflow-x-auto">
                    <table class="table table-striped mt-5 table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th class="whitespace-nowrap ">Name</th>
                                <th class="whitespace-nowrap text-center">Category</th>
                                <th class="whitespace-nowrap text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="whitespace-nowrap cursor-pointer hover:underline">Browser</td>
                                <td class="whitespace-nowrap text-center">System</td>
                                <td class="whitespace-nowrap text-center"><a href="{{ Route('report.browser') }}">View Details</a> </td>
                            </tr>

                            <tr>
                                <td class="whitespace-nowrap cursor-pointer hover:underline">Most Visited Page</td>
                                <td class="whitespace-nowrap text-center">System</td>
                                <td class="whitespace-nowrap text-center"><a href="{{ Route('report.MostVisitedPageIndex') }}">View Details</a></td>
                            </tr>
                            <tr>
                                <td class="whitespace-nowrap cursor-pointer hover:underline">User Type</td>
                                <td class="whitespace-nowrap text-center">System</td>
                                <td class="whitespace-nowrap text-center"><a href="{{ Route('report.UserType') }}">View Details</a></td>
                            </tr>
                            <tr>
                                <td class="whitespace-nowrap cursor-pointer hover:underline">Gender</td>
                                <td class="whitespace-nowrap text-center">Demographics</td>
                                <td class="whitespace-nowrap text-center"><a href="{{ Route('report.Gender') }}">View Details</a></td>
                            </tr>

                            <tr>
                                <td class="whitespace-nowrap cursor-pointer hover:underline">Payment By Type</td>
                                <td class="whitespace-nowrap text-center">Payment</td>
                                <td class="whitespace-nowrap text-center"><a href="{{ Route('report.PaymentByType') }}">View Details</a></td>
                            </tr>
                            <tr>
                                <td class="whitespace-nowrap cursor-pointer hover:underline">Sales over time</td>
                                <td class="whitespace-nowrap text-center">Sales</td>
                                <td class="whitespace-nowrap text-center"><a href="{{ Route('report.SalesOvertime') }}">View Details</a></td>
                            </tr>
                            <tr>
                                <td class="whitespace-nowrap cursor-pointer hover:underline">Sales by Product</td>
                                <td class="whitespace-nowrap text-center">Sales</td>
                                <td class="whitespace-nowrap text-center"><a href="{{ Route('report.SalesProd') }}">View Details</a></td>
                            </tr>
                            <tr>
                                <td class="whitespace-nowrap cursor-pointer hover:underline">Customer Total Spent </td>
                                <td class="whitespace-nowrap text-center">Sales</td>
                                <td class="whitespace-nowrap text-center"><a href="{{ Route('report.CustomersTotalSpent') }}">View Details</a></td>
                            </tr>
                            <tr>
                                <td class="whitespace-nowrap cursor-pointer hover:underline">Number of Sales by Product Brand</td>
                                <td class="whitespace-nowrap text-center">Sales</td>
                                <td class="whitespace-nowrap text-center"><a href="{{ Route('report.SalesBrand') }}">View Details</a></td>
                            </tr>
                            <tr>
                                <td class="whitespace-nowrap cursor-pointer hover:underline">Number of Sales by Product Category</td>
                                <td class="whitespace-nowrap text-center">Sales</td>
                                <td class="whitespace-nowrap text-center"><a href="{{ Route('report.SalesCategory') }}">View Details</a></td>
                            </tr>
                            <tr>
                                <td class="whitespace-nowrap cursor-pointer hover:underline">Number of Orders by Product Brand</td>
                                <td class="whitespace-nowrap text-center">Sales</td>
                                <td class="whitespace-nowrap text-center"><a href="{{ Route('report.OrderBrand') }}">View Details</a></td>
                            </tr>
                            <tr>
                                <td class="whitespace-nowrap cursor-pointer hover:underline">Number of Orders by Product Category</td>
                                <td class="whitespace-nowrap text-center">Sales</td>
                                <td class="whitespace-nowrap text-center"><a href="{{ Route('report.OrderCategory') }}">View Details</a></td>
                            </tr>

                            <tr>
                                <td class="whitespace-nowrap cursor-pointer hover:underline">Cancelled Orders</td>
                                <td class="whitespace-nowrap text-center">System</td>
                                <td class="whitespace-nowrap text-center"><a href="{{ Route('report.CancelledOrders') }}">View Details</a></td>
                            </tr>
                            <tr>
                                <td class="whitespace-nowrap cursor-pointer hover:underline">Cancellation Over Time</td>
                                <td class="whitespace-nowrap text-center">System</td>
                                <td class="whitespace-nowrap text-center"><a href="{{ Route('report.CancellationOverTime') }}">View Details</a></td>
                            </tr>
                            <tr>
                                <td class="whitespace-nowrap cursor-pointer hover:underline">Cancellation Reasons</td>
                                <td class="whitespace-nowrap text-center">System</td>
                                <td class="whitespace-nowrap text-center"><a href="{{ Route('report.CancellationReasons') }}">View Details</a></td>
                            </tr>
                            <tr>
                                <td class="whitespace-nowrap cursor-pointer hover:underline">Rejected Orders</td>
                                <td class="whitespace-nowrap text-center">System</td>
                                <td class="whitespace-nowrap text-center"><a href="{{ Route('report.RejectedOrders') }}">View Details</a></td>
                            </tr>

                            <tr>
                                <td class="whitespace-nowrap cursor-pointer hover:underline">Customer Per Month</td>
                                <td class="whitespace-nowrap text-center">System</td>
                                <td class="whitespace-nowrap text-center"><a href="{{ Route('report.customerPerMonth') }}">View Details</a></td>
                            </tr>

                            <tr>
                                <td class="whitespace-nowrap cursor-pointer hover:underline">Account Verification</td>
                                <td class="whitespace-nowrap text-center">System</td>
                                <td class="whitespace-nowrap text-center"><a href="{{ Route('report.AccountVerification') }}">View Details</a></td>
                            </tr>
                            <tr>
                                <td class="whitespace-nowrap cursor-pointer hover:underline">Quantity of Orders by Product</td>
                                <td class="whitespace-nowrap text-center">System</td>
                                <td class="whitespace-nowrap text-center"><a href="{{ Route('report.OrdersByProduct') }}">View Details</a></td>
                            </tr>
                            <tr>
                                <td class="whitespace-nowrap cursor-pointer hover:underline">Quantity of Orders by Customer</td>
                                <td class="whitespace-nowrap text-center">System</td>
                                <td class="whitespace-nowrap text-center"><a href="{{ Route('report.OrdersByCustomer') }}">View Details</a></td>
                            </tr>
                            <tr>
                                <td class="whitespace-nowrap cursor-pointer hover:underline">Product Ratings</td>
                                <td class="whitespace-nowrap text-center">System</td>
                                <td class="whitespace-nowrap text-center"><a href="{{ Route('report.ProductRatings') }}">View Details</a></td>
                            </tr>



                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End: Reports Table -->
        </div>
    </div>
</div>
@endsection

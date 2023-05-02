@extends('admin.layout.admin')
@section('content')
@section('title', 'Dashboard')

<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 2xl:col-span-12">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        General Report
                    </h2>
                    <a href="" class="ml-auto flex items-center text-primary"> <i data-lucide="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data </a>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="shopping-cart" class="report-box__icon text-primary"></i>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{ $number_of_events }}</div>
                                <div class="text-base text-slate-500 mt-1">Events Total</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="monitor" class="report-box__icon text-primary"></i>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{ $number_of_teams }}</div>
                                <div class="text-base text-slate-500 mt-1">Teams Total</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="check-circle" class="report-box__icon text-primary"></i>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{ $number_of_schedule }}</div>
                                <div class="text-base text-slate-500 mt-1">Total Schedule</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="more-horizontal" class="report-box__icon text-primary"></i>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{ $number_of_scored_events }}</div>
                                <div class="text-base text-slate-500 mt-1">Scored Events</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: General Report -->
            <!-- BEGIN: Sales Report -->
            <div class="col-span-12 box">
                <div class="overflow-x-auto p-5">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th class="whitespace-nowrap text-center">Rank</th>
                                <th class="whitespace-nowrap text-center">Team Name</th>
                                <th class="whitespace-nowrap text-center">Points</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teams as $team)
                                <tr>
                                    <td class="whitespace-nowrap text-center">{{ $team->ranking }}</td>
                                    <td class="whitespace-nowrap text-center">{{ $team->team_name }}</td>
                                    <td class="whitespace-nowrap text-center">{{ number_format($team->overall)   }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


            <!-- END: Sales Report -->

        </div>
    </div>
</div>

@endsection
@push('scripts')

@endpush



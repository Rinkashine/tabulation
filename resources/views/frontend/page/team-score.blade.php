@extends('frontend.layout.base')
@section('title')
{{ $team_name }}
@endsection
@section('content')

<div class="flex items-center justify-center">
    <div style="width:60rem">
        <!-- Begin Header of Product -->
        <div class="px-5 pt-5 intro-y box mt-7">
            <div class="flex flex-col pb-5 -mx-5 border-b lg:flex-row border-slate-200/60 dark:border-darkmode-400">
                <div class="flex items-center justify-center flex-1 px-5 lg:justify-start">
                    <div class="ml-5 mr-5 text-lg">
                        <div class="font-medium sm:text-xl sm:whitespace-normal"><a href="{{ url()->previous() }}" class="mr-2 btn">←</a> {{ $team_name }}</div>
                    </div>
                    <div class="flex-1 px-5 pt-5 mt-6 border-t border-l border-r lg:mt-0 border-slate-200/60 dark:border-darkmode-400 lg:border-t-0 lg:pt-0">
                        <div class="font-medium text-center lg:text-left lg:mt-3">Team Details</div>
                        <div class="flex flex-col items-center justify-center mt-4 lg:items-start">
                            <div class="flex items-center truncate sm:whitespace-normal">Current Points: {{ $current_points }}</div>
                            <div class="flex items-center mt-3 truncate sm:whitespace-normal">Rank: {{ $rank }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto p-5">
                <table class="table table-bordered table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th class="whitespace-nowrap">Event Name:</th>
                            <th class="whitespace-nowrap text-center">Position</th>
                            <th class="whitespace-nowrap text-center">Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($team_data as $data)
                            <tr>
                                <td class="whitespace-nowrap">{{ $data->event_name }}</td>
                                <td class="whitespace-nowrap text-center">{{ $data->position }}</td>
                                <td class="whitespace-nowrap text-center">{{ $data->score }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="whitespace-nowrap" colspan="3">No Data Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection

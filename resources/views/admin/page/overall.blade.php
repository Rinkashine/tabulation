@extends('admin.layout.admin')
@section('content')
@section('title', 'Overall')

<!-- Begin: Events Table -->
<div class="grid grid-cols-12 gap-x-6 mt-5 pb-20">
    <div class="intro-y col-span-12">
        <div class="intro-y box p-5">
            <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
            <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5"> Overall </div>
                <div class="mt-5">
                    <div class="overflow-x-auto">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap text-center">Rank</th>
                                    <th class="whitespace-nowrap text-center">Team Name</th>
                                    <th class="whitespace-nowrap text-center">Points</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($teams as $team)
                                    <tr>
                                        <td class="whitespace-nowrap text-center">{{ $team->rank }}</td>
                                        <td class="whitespace-nowrap text-center">{{ $team->team_name }}</td>
                                        <td class="whitespace-nowrap text-center">{{ number_format($team->overall) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection
@push('scripts')

@endpush

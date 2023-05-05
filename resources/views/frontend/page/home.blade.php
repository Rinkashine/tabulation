@extends('frontend.layout.base')
@section('content')
@section('title', 'Home')
<div class="content content--top-nav">
    <h1 class="intro-y text-xl font-medium mt-10">
        The Partial and Unofficial Score - Deduction and Special/Additional Points are not yet included
    </h1>
    <div class="grid grid-cols-10 gap-6 mt-5">
        @foreach ($teams as $team)
            <div class="intro-y col-span-10 sm:cols-span-5 md:col-span-5   lg:col-span-2 2xl:col-span-2">
                <a href="{{ route('TeamScore.show',['team' => $team->team_name]) }}">
                    <div class=" box zoom-in">
                        <div class="p-5">
                            <div class="w-full flex items-center justify-center">
                                @if (Storage::disk('s3')->exists('team/'.$team->photo))
                                    <img src="{{ Storage::disk('s3')->url('team/'.$team->photo) }}"  class="rounded-md" alt="Missing team Image">
                                @else
                                    <img src="{{ asset('dist/images/ImageNotFound.png') }}" data-action="zoom" class="rounded-md" alt="Missing team Image">
                                @endif
                            </div>
                            <div class="text-slate-600 dark:text-slate-500 mt-5">
                                <div class="flex items-center mt-2"> <i data-lucide="layers" class="w-4 h-4 mr-2"></i> Current Points: {{ $team->overall }} </div>
                                <div class="flex items-center mt-2"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> Rank: {{ $team->ranking }} </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection

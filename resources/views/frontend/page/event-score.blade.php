@extends('frontend.layout.base')
@section('title', 'Ranking By Event')
@section('content')

<div class="flex items-center justify-center ">
        <!-- Begin Header of Product -->
        <div class="p-5 intro-y box mt-7 w-full">
            <div class="flex flex-col pb-5 -mx-5 border-b lg:flex-row border-slate-200/60 dark:border-darkmode-400">
                <div class="flex items-center justify-center flex-1 px-5 lg:justify-start">
                    <div class="ml-5 mr-5 text-lg">
                        <div class="font-medium sm:text-xl sm:whitespace-normal">
                            Ranking
                        </div>
                    </div>

                </div>
            </div>

            <div class="p-5">
                <livewire:frontend.ranking-by-event/>
            </div>
        </div>

</div>


@endsection

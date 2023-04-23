<div>
    <form wire:submit.prevent="Tabulate">
        <div class="grid grid-cols-12 gap-x-6 mt-5 pb-20">
            <div class="intro-y col-span-12">
                <div class="intro-y box p-5">
                    <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                    <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5"> Tabulating: {{ $event->name }} | Classificaion: {{ $classification->name }}</div>
                        <div class="mt-5">
                            @foreach ($teams as $key=>$team)
                            <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                <div class="form-label xl:w-64 xl:!mr-10">
                                    <div class="text-left">
                                        <div class="flex items-center">
                                            <div class="font-medium">

                                                {{ $team->name }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full mt-3 xl:mt-0 flex-1">

                                    <select wire:model="data.{{ $key }}.position" class="form-select w-full @error('event') border-danger @enderror"  >
                                        <option value="">Select a Position</option>
                                        @foreach ($classification->classificationTransactions as $point)
                                            <option value="{{ $point->id }}">{{ $point->score }} - {{ $point->position }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger mt-2">@error('data.'.$key.'.position'){{$message}}@enderror</div>
                                </div>
                            </div>
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>
            <div class="intro-y col-span-12 flex justify-end mt-5">
                <button type="submit" class="btn btn-primary">Tabulate </button>
            </div>
        </div>
    </form>
</div>

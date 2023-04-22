<div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <button class="btn btn-primary shadow-md mr-2" data-tw-toggle="modal" data-tw-target="#add-item-modal">Add New Points</button>
            <div class="hidden md:block mx-auto text-slate-500">
                @if($points->count() == 0)
                    Showing 0 to 0 of 0 entries
                @else
                    Showing {{$points->firstItem()}} to {{$points->lastItem()}} of {{$points->total()}} entries
                @endif
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">Postion</th>
                        <th class="whitespace-nowrap text-center">Score</th>
                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($points as $point)
                        <tr class="intro-x">
                            <td class="w-1/2 !py-4">{{ $point->position }} </td>
                            <td class="w-1/2 !py-4 text-center">{{ $point->score }} </td>

                            <td class="table-report__action">
                                <div class="flex justify-center items-center">
                                    <button wire:click="selectItem({{ $point->id }},'edit')" class="flex items-center text-success whitespace-nowrap mr-5">
                                        <i class="fa-regular fa-pen-to-square mr-1"></i>Edit
                                    </button>
                                    <button wire:click="selectItem({{ $point->id }},'delete')" class="flex items-center text-danger whitespace-nowrap mr-5">
                                        <i class="fa-regular fa-trash-can mr-1"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No Results Found <strong class="ml-1"> {{ $search }}</strong> </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            <nav class="w-full sm:w-auto sm:mr-auto">
                {!! $points->onEachSide(1)->links() !!}
            </nav>
            <select wire:model="perPage" class="w-20 form-select box mt-3 sm:mt-0">
                <option>10</option>
                <option>25</option>
                <option>35</option>
                <option>50</option>
            </select>
        </div>
        <!-- END: Pagination -->
    </div>
</div>


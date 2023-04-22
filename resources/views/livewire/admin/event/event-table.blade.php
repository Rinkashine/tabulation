<div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <button class="btn btn-primary shadow-md mr-2" data-tw-toggle="modal" data-tw-target="#add-item-modal">Add New Team</button>
            <div class="hidden md:block mx-auto text-slate-500">
                @if($events->count() == 0)
                    Showing 0 to 0 of 0 entries
                @else
                    Showing {{$events->firstItem()}} to {{$events->lastItem()}} of {{$events->total()}} entries
                @endif
            </div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-slate-500">
                    <input type="search" wire:model.lazy="search" class="form-control w-56 box " placeholder="Search...">
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">Event Name</th>
                        <th class="text-center whitespace-nowrap">Status</th>
                        <th class="text-center whitespace-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($events as $event)
                        <tr class="intro-x">
                            <td class="whitespace-nowrap">{{ $event->name }} </td>
                            <td class="whitespace-nowrap text-center">
                                @if($event->status == 0)
                                    Not Configured
                                @elseif($event->status == 1)
                                    Configured
                                @endif
                            </td>
                            <td class="table-report__action">
                                <div class="flex justify-center items-center">
                                    @if($event->status == 1)
                                    <button wire:click="selectItem({{ $event->id }},'view_score')" class="flex items-center text-primary whitespace-nowrap mr-5">
                                        <i class="fa-regular fa-eye mr-1"></i>View
                                    </button>
                                    @endif
                                    <button wire:click="selectItem({{ $event->id }},'edit')" class="flex items-center text-success whitespace-nowrap mr-5">
                                        <i class="fa-regular fa-pen-to-square mr-1"></i>Edit
                                    </button>
                                    @if($event->status == 1)
                                        <button wire:click="selectItem({{ $event->id }},'unset_score')" class="flex items-center text-danger whitespace-nowrap mr-5">
                                            <i class="fa-solid fa-link-slash mr-1"></i> unset score
                                        </button>
                                    @endif
                                    <button wire:click="selectItem({{ $event->id }},'delete')" class="flex items-center text-danger whitespace-nowrap mr-5">
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
                {!! $events->onEachSide(1)->links() !!}
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


<div  wire:ignore.self  id="view-scores-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Scores for {{ $event_name }}</h2>
            </div> <!-- END: Modal Header -->
            <!-- BEGIN: Modal Body -->
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                <div class="col-span-12 ">
                    <div class="overflow-x-auto w-full">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">Team Name</th>
                                    <th class="whitespace-nowrap text-center">Position</th>
                                    <th class="whitespace-nowrap text-center">Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($event_scores as $event)
                                    <tr>
                                        <td class="whitespace-nowrap">{{ $event->team->name }}</td>
                                        <td class="whitespace-nowrap text-center">{{ $event->classification_pointing->position }}</td>
                                        <td class="whitespace-nowrap text-center">{{ number_format($event->classification_pointing->score) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div> <!-- END: Modal Body -->
            <!-- BEGIN: Modal Footer -->
            <div class="modal-footer">
                 <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Close</button>
            </div>
            <!-- END: Modal Footer -->
        </div>
    </div>
</div>

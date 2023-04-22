
<div wire:ignore.self id="add-item-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">
                    Add New Position
                </h2>
            </div>
            <form wire:submit.prevent="StorePositionData">
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    @csrf
                    <div class="col-span-12">
                        <label for="name" class="form-label w-full flex flex-col sm:flex-row">Position: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Required</span> </label>
                        <input type="text" id="title" wire:model.lazy="position" wire:offline.class="border-warning"  class="form-control flex-1  @error('position') border-danger @enderror" placeholder="Position Name" >
                        <div class="text-danger mt-2">@error('position'){{$message}}@enderror</div>
                    </div>
                    <div class="col-span-12">
                        <label for="name" class="form-label w-full flex flex-col sm:flex-row">Score: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Required</span> </label>
                        <input type="number" id="title" wire:model.lazy="score" wire:offline.class="border-warning"  class="form-control flex-1  @error('score') border-danger @enderror" placeholder="Score" >
                        <div class="text-danger mt-2">@error('score'){{$message}}@enderror</div>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button wire:click="closeModal" type="button" class="btn btn-outline-secondary w-32 mr-1" wire:offline.attr="disabled">Cancel</button>
                    <input type="submit" class="btn btn-primary w-32" value="Submit" wire:offline.attr="disabled">
                </div>
            </form>
        </div>
    </div>
</div>






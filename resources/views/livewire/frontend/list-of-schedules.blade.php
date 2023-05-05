<div>
    <select wire:model="name"  class="form-select w-full @error('event') border-danger @enderror"  >
        <option value="">Select Schedule</option>
        @foreach ($schedules as $schedule)
            <option value="{{ $schedule->id }}">{{ $schedule->name }}</option>
        @endforeach
    </select>
    @if(!empty($name))
    <div class="mt-5">
        <img src="{{ Storage::disk('s3')->url('schedule/'.$schedule_img) }}" data-action="zoom" class="object-contain w-full h-full" alt="Missing Schedule Image">
    </div>
    @endif
</div>

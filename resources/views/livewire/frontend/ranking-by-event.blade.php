<div>
    <select wire:model="name"  class="form-select w-full @error('event') border-danger @enderror"  >
        <option value="">Select A Event</option>
        @foreach ($events as $event)
            <option value="{{ $event->name }}">{{ $event->name }}</option>
        @endforeach
    </select>

    @if(!empty($name))
    <div class="overflow-x-auto">
        <table class="table table-bordered table-hover table-striped mt-5">
            <thead class="table-dark">
                <tr>
                    <th class="whitespace-nowrap">Event Name:</th>
                    <th class="whitespace-nowrap text-center">Position</th>
                    <th class="whitespace-nowrap text-center">Score</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($event_data as $data)
                    <tr>
                        <td class="whitespace-nowrap">{{ $data->team_name }}</td>
                        <td class="whitespace-nowrap text-center">{{ $data->position }}</td>
                        <td class="whitespace-nowrap text-center">{{ $data->score }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3"> Event Not Yet Scored</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @endif
</div>

<?php

namespace App\Http\Livewire\Admin\Event;

use Livewire\Component;
use App\Models\Event;
use Livewire\WithPagination;

class EventTable extends Component
{
    use WithPagination;

    public $perPage = 12;

    public $search = null;

    protected $queryString = ['search' => ['except' => '']];

    protected $paginationTheme = 'bootstrap';

    public $action;

    public $selectedItem;

    protected $listeners = [
        'refreshParent' => '$refresh',
    ];

    public function selectItem($itemId, $action)
    {
        $this->selectedItem = $itemId;

        if ($action == 'delete') {
            $this->emit('getModelDeleteModalId', $this->selectedItem);
            $this->dispatchBrowserEvent('openDeleteModal');
        }elseif($action == 'view_score'){
            $this->emit('getModelViewId', $this->selectedItem);
            $this->dispatchBrowserEvent('openViewScoreModal');
        }elseif($action == 'unset_score'){
            $this->emit('getModelUnsetId', $this->selectedItem);
            $this->dispatchBrowserEvent('openUnsetModal');
        }
        else {
            $this->emit('getModelId', $this->selectedItem);
            $this->dispatchBrowserEvent('OpenEditModal');
        }
        $this->action = $action;
    }
    public function render()
    {
        $events = Event::search($this->search)
        ->orderBy('name')
        ->paginate($this->perPage);
        return view('livewire.admin.event.event-table',[
            'events' => $events
        ]);
    }
}

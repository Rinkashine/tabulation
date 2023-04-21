<?php

namespace App\Http\Livewire\Admin\Team;

use Livewire\Component;
use App\Models\Team;
use Livewire\WithPagination;

class TeamTable extends Component
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
        } elseif ($action == 'change_photo') {
            $this->emit('getModelInfo', $this->selectedItem);
            $this->dispatchBrowserEvent('openChangePhotoModal');

        } else {
            $this->emit('getModelId', $this->selectedItem);
            $this->dispatchBrowserEvent('OpenEditModal');
        }
        $this->action = $action;
    }


    public function render()
    {
        $teams = Team::search($this->search)
        ->orderBy('name')
        ->paginate($this->perPage);

        return view('livewire.admin.team.team-table',[
            'teams' => $teams,
        ]);
    }
}

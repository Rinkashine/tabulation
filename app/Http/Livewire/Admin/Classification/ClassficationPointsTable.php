<?php

namespace App\Http\Livewire\Admin\Classification;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ClassificationPoint;

class ClassficationPointsTable extends Component
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

    public $classification;

    public function selectItem($itemId, $action)
    {
        $this->selectedItem = $itemId;

        if ($action == 'delete') {
            $this->emit('getModelDeleteModalId', $this->selectedItem);
            $this->dispatchBrowserEvent('openDeleteModal');
        }else {
            $this->emit('getModelId', $this->selectedItem);
            $this->dispatchBrowserEvent('OpenEditModal');
        }
        $this->action = $action;
    }


    public function mount($classification){
        $this->classification = $classification;
    }
    public function render()
    {
        $points = ClassificationPoint::where('classification_id',$this->classification->id)
        ->orderby('score','desc')
        ->paginate($this->perPage);;
        return view('livewire.admin.classification.classfication-points-table',[
            'points' => $points,
        ]);
    }
}

<?php

namespace App\Http\Livewire\Admin\Transaction;

use Livewire\Component;

class OrderApproval extends Component
{
    public $order_id;

    public function mount($order)
    {
        $this->order_id = $order->id;
    }

    public $action;

    public $selectedItem;

    public function selectItem($itemId, $action)
    {
        $this->selectedItem = $itemId;

        if ($action == 'reject') {
            $this->emit('getModelRejectId', $this->selectedItem);

        } elseif ($action == 'approved') {
            $this->emit('getModelApprovedId', $this->selectedItem);
            $this->dispatchBrowserEvent('OpenApprovedModal');
        }
        $this->action = $action;
    }

    public function render()
    {
        return view('livewire.admin.transaction.order-approval');
    }
}

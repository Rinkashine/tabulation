<?php

namespace App\Http\Livewire\Admin\Transaction;

use Livewire\Component;
use App\Models\Customer;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderItems;
class OrderDetails extends Component
{
    public $model_id;

    protected $listeners = [
        'refreshParent' => '$refresh',
    ];

    public function mount($orderdetails){
        $this->model_id = $orderdetails->id;
    }
    public function render()
    {
        $orderdetails = CustomerOrder::findorfail($this->model_id);
        $customerinfo = Customer::withTrashed()->findorfail($orderdetails->customers_id);
        $products = CustomerOrderItems::where('customer_order_id', $orderdetails->id)->get();

        return view('livewire.admin.transaction.order-details',[
            'orderdetails' => $orderdetails,
            'products' => $products,
            'customerinfo' => $customerinfo,
        ]);
    }
}

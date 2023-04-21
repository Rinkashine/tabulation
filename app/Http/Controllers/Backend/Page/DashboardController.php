<?php

namespace App\Http\Controllers\Backend\Page;

use App\Models\User;
use App\Models\Product;
use App\Models\Customer;
use Spatie\Analytics\Period;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderItems;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.page.dashboard');
    }
}

<?php

namespace App\Http\Controllers\Backend\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classification;
class ClassificationController extends Controller
{
    public function index()
    {
        return view('admin.page.classification');
    }

    public function show(Classification $classification){
        return view('admin.page.classificationshow',[
            'classification' => $classification
        ]);
    }
}

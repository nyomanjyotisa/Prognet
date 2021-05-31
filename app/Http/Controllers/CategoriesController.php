<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function categories(){
        return view('layouts.categories');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminCollectionController extends Controller
{
    public function index()
    {
        return view('admin.collections');
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class CollectionController extends Controller
{
    public function index()
    {
        return view('user.collections');
    }
}

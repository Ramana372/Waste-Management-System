<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Waste;


class WasteController extends Controller
{
    public function index()
    {
        return response()->json(Waste::all());
    }

    public function store(Request $request)
    {
        $waste = Waste::create([
            'type' => $request->type,
            'amount' => $request->amount,
            'location' => $request->location,
        ]);

        return response()->json($waste, 201);
    }
}

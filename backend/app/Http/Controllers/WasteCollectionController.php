<?php

namespace App\Http\Controllers;

use App\Models\WasteCollection;
use Illuminate\Http\Request;

class WasteCollectionController extends Controller
{
    public function index()
    {
        $collections = WasteCollection::with(['location', 'wasteCategory'])->get();
        return response()->json($collections);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'location_id' => 'required|exists:locations,id',
            'waste_category_id' => 'required|exists:waste_categories,id',
            'quantity' => 'required|numeric|min:0',
            'collector_notes' => 'nullable|string',
            'date' => 'required|date',
            'status' => 'required|in:PENDING,IN_PROGRESS,COMPLETED'
        ]);

        $collection = WasteCollection::create($validated);
        return response()->json($collection, 201);
    }

    public function show(WasteCollection $collection)
    {
        return response()->json($collection->load(['location', 'wasteCategory']));
    }

    public function update(Request $request, WasteCollection $collection)
    {
        $validated = $request->validate([
            'status' => 'required|in:PENDING,IN_PROGRESS,COMPLETED'
        ]);

        $collection->update($validated);
        return response()->json($collection);
    }
} 
<?php

namespace App\Http\Controllers;

use App\Models\Transportation;
use Illuminate\Http\Request;

class TransportationController extends Controller
{
    public function index()
    {
        $transportations = Transportation::with(['wasteCollection', 'vehicle'])->get();
        return response()->json($transportations);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'waste_collection_id' => 'required|exists:waste_collections,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'departure_time' => 'required|date',
            'arrival_time' => 'nullable|date',
            'start_location' => 'required|string',
            'destination' => 'required|string',
            'status' => 'required|in:PENDING,IN_PROGRESS,COMPLETED',
            'route_details' => 'nullable|json',
            'driver_notes' => 'nullable|string'
        ]);

        $transportation = Transportation::create($validated);
        return response()->json($transportation, 201);
    }

    public function show(Transportation $transportation)
    {
        return response()->json($transportation->load(['wasteCollection', 'vehicle']));
    }

    public function update(Request $request, Transportation $transportation)
    {
        $validated = $request->validate([
            'status' => 'required|in:PENDING,IN_PROGRESS,COMPLETED',
            'arrival_time' => 'nullable|date',
            'driver_notes' => 'nullable|string'
        ]);

        $transportation->update($validated);
        return response()->json($transportation);
    }
} 
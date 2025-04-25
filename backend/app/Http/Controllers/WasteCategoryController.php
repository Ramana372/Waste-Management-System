<?php

namespace App\Http\Controllers;

use App\Models\WasteCategory;
use Illuminate\Http\Request;

class WasteCategoryController extends Controller
{
    public function index()
    {
        $categories = WasteCategory::all();
        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'handling_instructions' => 'required|string',
            'is_hazardous' => 'required|boolean',
            'segregation_requirements' => 'required|string'
        ]);

        $category = WasteCategory::create($validated);
        return response()->json($category, 201);
    }

    public function show(WasteCategory $category)
    {
        return response()->json($category);
    }

    public function update(Request $request, WasteCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'handling_instructions' => 'required|string',
            'is_hazardous' => 'required|boolean',
            'segregation_requirements' => 'required|string'
        ]);

        $category->update($validated);
        return response()->json($category);
    }
} 
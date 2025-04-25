<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'transportation_id',
        'waste_category_id',
        'disposal_method',
        'disposal_date',
        'quantity_disposed',
        'facility_name',
        'treatment_method',
        'environmental_impact',
        'disposal_cost',
        'compliance_status',
        'notes'
    ];

    public function transportation()
    {
        return $this->belongsTo(Transportation::class);
    }

    public function wasteCategory()
    {
        return $this->belongsTo(WasteCategory::class);
    }
} 
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteCollection extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'location_id',
        'waste_category_id',
        'quantity',
        'status',
        'collector_notes'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function wasteCategory()
    {
        return $this->belongsTo(WasteCategory::class);
    }

    public function transportation()
    {
        return $this->hasOne(Transportation::class);
    }
} 
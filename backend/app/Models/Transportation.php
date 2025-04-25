<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transportation extends Model
{
    use HasFactory;

    protected $fillable = [
        'waste_collection_id',
        'vehicle_id',
        'departure_time',
        'arrival_time',
        'start_location',
        'destination',
        'status',
        'route_details',
        'driver_notes'
    ];

    public function wasteCollection()
    {
        return $this->belongsTo(WasteCollection::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function disposal()
    {
        return $this->hasOne(Disposal::class);
    }
} 
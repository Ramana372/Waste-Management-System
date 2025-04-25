<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transportations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('waste_collection_id')->constrained()->onDelete('cascade');
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
            $table->dateTime('departure_time');
            $table->dateTime('arrival_time')->nullable();
            $table->string('start_location');
            $table->string('destination');
            $table->string('status');
            $table->json('route_details')->nullable();
            $table->text('driver_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transportations');
    }
}; 
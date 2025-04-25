<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_number')->unique();
            $table->string('type');
            $table->decimal('capacity', 10, 2);
            $table->string('current_status');
            $table->date('last_maintenance_date');
            $table->date('next_maintenance_due');
            $table->decimal('fuel_efficiency', 5, 2)->nullable();
            $table->string('registration_number')->unique();
            $table->date('insurance_expiry');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}; 
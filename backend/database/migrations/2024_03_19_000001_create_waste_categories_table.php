<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('waste_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('handling_instructions');
            $table->boolean('is_hazardous')->default(false);
            $table->text('segregation_requirements');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('waste_categories');
    }
}; 
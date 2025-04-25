<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('disposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transportation_id')->constrained()->onDelete('cascade');
            $table->foreignId('waste_category_id')->constrained()->onDelete('cascade');
            $table->string('disposal_method');
            $table->dateTime('disposal_date');
            $table->decimal('quantity_disposed', 10, 2);
            $table->string('facility_name');
            $table->string('treatment_method');
            $table->text('environmental_impact')->nullable();
            $table->decimal('disposal_cost', 10, 2)->nullable();
            $table->string('compliance_status');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('disposals');
    }
}; 
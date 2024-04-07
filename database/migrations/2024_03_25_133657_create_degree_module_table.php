<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Create a pivot table for degrees and modules, allowing the linking of the two. One degree will have many modules
     * One module can belong to multiple degrees.
     *
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('degree_module', function (Blueprint $table) {
            $table->unsignedBigInteger('degree_id');
            $table->unsignedBigInteger('module_id');
            $table->timestamps();

            //Create composite key
            $table->primary(['degree_id', 'module_id']);

            //Create pivot table relationships
            $table->foreign('degree_id')->references('id')->on('degrees');
            $table->foreign('module_id')->references('id')->on('modules');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('degree_module');
    }
};

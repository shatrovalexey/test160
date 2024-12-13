<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('streets', function (Blueprint $table) {
            $table->string('region_name');
            $table->string('city_name');
            $table->string('name');
            $table->timestamps();

            $table->primary(['region_name', 'city_name', 'name',]);
            $table->index(['city_name',]);
            $table->fullText(['region_name', 'city_name', 'name',]);

            $table
                ->foreign('region_name')
                ->references('name')
                ->on('regions')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table
                ->foreign('city_name')
                ->references('name')
                ->on('citys')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('streeta');
    }
};

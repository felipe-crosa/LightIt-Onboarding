<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('departure_id')->constrained('cities')->cascadeOnDelete();
            $table->foreignId('arrival_id')->constrained('cities')->cascadeOnDelete();
            $table->foreignId('airline_id')->cascadeOnDelete();
            $table->dateTime('departure_date');
            $table->dateTime('arrival_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flights');
    }
};

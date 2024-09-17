<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('plan_id')->unique();
            $table->string('plan_variation_id')->unique();
            $table->enum('interval', ['MONTHLY', 'ANNUAL']);
            $table->decimal('price', 6, 2);
            $table->boolean('active')->default(true);
            $table->integer('teams_limit')->nullable();
            $table->integer('trial_period_days')->nullable();
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
        Schema::dropIfExists('plans');
    }
};

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
        Schema::create('return_slips', function (Blueprint $table) {
            $table->id();
            $table->integer('return_id')->nullable();
            $table->integer('product_id')->nullable();

            $table->string('location')->nullable();
            $table->string('checkoutdate')->nullable();
            $table->string('client')->nullable();
            $table->string('drnumber')->nullable();
            $table->string('rsnumber')->nullable();
            $table->string('stockout_id')->nullable();
            $table->string('sku')->nullable();
            $table->string('productcode')->nullable();
            $table->string('model')->nullable();
            $table->string('uom')->nullable();
            $table->string('itemdescription')->nullable();
            $table->string('serialnumber')->nullable();
            $table->string('quantity')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_slips');
    }
};

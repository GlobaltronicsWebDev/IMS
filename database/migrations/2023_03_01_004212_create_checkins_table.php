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
        Schema::create('checkins', function (Blueprint $table) {
            $table->id();
            $table->string('location')->nullable();
            $table->string('checkindate')->nullable();
            $table->string('ponumber')->nullable();
            $table->string('strnumber')->nullable();

            $table->unsignedBigInteger('category_id');
            $table->string('brand')->nullable();
            $table->string('productcode')->nullable();
            $table->string('sku')->nullable();
            $table->string('model')->nullable();
            $table->string('itemdescription')->nullable();
            $table->string('serialnumber')->nullable();

            $table->string('quantity')->nullable();
            $table->string('uom')->nullable();
            $table->string('status')->nullable();
            $table->string('remarks')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkins');
    }
};

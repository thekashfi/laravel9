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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('summary', 255)->nullable();
            $table->text('description')->nullable();
            $table->text('text');
            $table->string('slug', 100)->unique();
            $table->integer('price')->default(0);
            $table->integer('order')->nullable()->default(0);
            $table->integer('old_price')->default(0)->nullable();
            $table->boolean('is_active')->default(1);
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
        Schema::dropIfExists('contracts');
    }
};

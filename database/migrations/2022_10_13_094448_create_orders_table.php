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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('contract_id')
                ->nullable()
                ->references('id')
                ->on('contracts')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->string('contract_name', 100);
            $table->string('uuid', 255)->unique();
            $table->text('contract_text')->nullable();
            $table->boolean('is_paid')->default(false);
            $table->string('trans1', 255)->nullable();
            $table->string('trans2', 255)->nullable();
            $table->text('result')->nullable();
            $table->integer('amount');
            $table->ipAddress('ip');
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
        Schema::dropIfExists('orders');
    }
};

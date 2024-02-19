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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('hotel_plan_id')->references('id')->on('hotel_plans')->onDelete('cascade');
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->text('message')->nullable();
            $table->string('memo')->nullable();
            $table->enum('status', ['予約中', '予約確定', 'キャンセル'])->default('予約中');
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
        Schema::dropIfExists('reservations');
    }
};

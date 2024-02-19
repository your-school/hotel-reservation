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
        Schema::create('hotel_plans', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('price');
            $table->string('meal')->nullable(); //0:素泊まり 1:朝食のみ 2:夕食のみ 3:朝・夜2食付き
            $table->foreignId('room_type_id')->references('id')->on('room_types')->onDelete('cascade');
            $table->foreignId('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
            $table->timestamps();
        });
    }

    // hotel_plans テーブル
    // 役割: 宿泊プランを定義するためのテーブルです。
    // カラムの説明:
    // id: レコードを一意に識別するためのID。
    // title: 宿泊プランのタイトル（例: 朝食付きプラン、ビジネスプラン）。
    // description: 宿泊プランの詳細や提供されるサービスに関する説明。
    // price: 宿泊プランの価格。
    // created_at, updated_at: レコードの作成日時と更新日時。


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotel_plans');
    }
};

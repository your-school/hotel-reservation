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
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    // room_types テーブル
    // 役割: 部屋の種別を定義するためのテーブルです。
    // カラムの説明:
    // id: レコードを一意に識別するためのID。
    // title: 部屋の種別名（例: シングルルーム、ダブルルーム）。
    // description: 部屋の説明や特徴を記述します。
    // created_at, updated_at: レコードの作成日時と更新日時。

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_types');
    }
};

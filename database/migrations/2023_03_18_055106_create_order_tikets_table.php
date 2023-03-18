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
        Schema::create('order_tikets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('tiket_id');
            $table->string('nama_pemesan');
            $table->string('email_pemesan');
            $table->string('nohp_pemesan');
            $table->string('alamat_pemesan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_tikets');
    }
};

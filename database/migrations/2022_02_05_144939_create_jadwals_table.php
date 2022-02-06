<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->integer('pegawai_code');
            $table->integer('ruangan_jadwal_id');
            $table->integer('shift_jadwal_id');
            $table->string('hari', 10);
            $table->integer('bulan');
            $table->integer('tahun');
            $table->time('jadwal_jam_masuk');
            $table->time('jadwal_jam_pulang');
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
        Schema::dropIfExists('jadwals');
    }
}

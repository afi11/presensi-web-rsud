<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIzinTidakPresensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('izin_tidak_presensi', function (Blueprint $table) {
            $table->id();
            $table->integer('pegawai_code');
            $table->integer('jadwal_id');
            $table->date('tanggal_presensi');
            $table->string('tipe_presensi', 20);
            $table->string('file_izin');
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
        Schema::dropIfExists('izin_tidak_presensis');
    }
}

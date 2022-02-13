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
        // Schema::create('jadwal', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('pegawaiCode', 100);
        //     $table->integer('idDivisi');
        //     $table->integer('idWaktuShift');
        //     $table->integer('idWaktuShift');
        //     $table->date('tanggal');
        //     $table->integer('bulan');
        //     $table->integer('tahun');
        //     $table->timestamps();
        // });
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

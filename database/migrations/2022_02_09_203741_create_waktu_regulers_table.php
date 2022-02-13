<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaktuRegulersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waktu_reguler', function (Blueprint $table) {
            $table->id();
            $table->string('hariKerja', 50);
            $table->time('jam_mulai_masuk');
            $table->time('jam_akhir_masuk');
            $table->time('jam_awal_pulang');
            $table->time('jam_akhir_pulang');
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
        Schema::dropIfExists('waktu_regulers');
    }
}

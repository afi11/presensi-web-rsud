<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presensi', function (Blueprint $table) {
            $table->id();
            $table->integer('pegawaiCode');
            $table->integer('idRuleIzin')->nullable();
            $table->integer('idWaktuReguler')->nullable();
            $table->integer('idWaktuShift')->nullable();
            $table->integer('idRuleTelat')->nullable();
            $table->date('tanggalPresensi')->nullable();
            $table->time('jamPresensiMasuk')->nullable();
            $table->time('jamPresensiPulang')->nullable();
            $table->time('telatMasuk')->nullable();
            $table->time('jarakWaktuPulang')->nullable();
            $table->string('jarakPresensi', 20)->nullable();
            $table->string('latitudePresensi')->nullable();
            $table->string('longitudePresensi')->nullable();
            $table->string('keteranganIzin')->nullable();
            $table->date('tanggalMulaiIzin')->nullable();
            $table->date('tanggalAkhirIzin')->nullable();
            $table->string('dokumenPendukung')->nullable();
            $table->string('statusIzin')->nullable();
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
        Schema::dropIfExists('presensis');
    }
}

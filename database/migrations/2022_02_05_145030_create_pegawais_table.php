<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50);
            $table->integer('idDivisi');
            $table->integer('statusShift')->default(0);
            $table->integer('idJamKerjaShift')->nullable();
            $table->string('nik', 100)->nullable();
            $table->string('nama', 255);
            $table->string('gender', 10);
            $table->string('status', 20);
            $table->string('telepon', 20)->nullable();
            $table->date('tglLahir')->nullable();
            $table->mediumText('alamat')->nullable();
            $table->mediumText('foto_pegawai')->default('default.jpg')->nullable();
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
        Schema::dropIfExists('pegawais');
    }
}

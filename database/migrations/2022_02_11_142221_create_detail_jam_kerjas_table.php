<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailJamKerjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_jam_kerja', function (Blueprint $table) {
            $table->id();
            $table->integer('idJamKerja')->nullable();
            $table->string('shift', 50);
            $table->time('jam_mulai_masuk');
            $table->time('jam_akhir_masuk');
            $table->time('jam_awal_pulang');
            $table->time('jam_akhir_pulang');
            $table->integer('is_active');
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
        Schema::dropIfExists('detail_jam_kerjas');
    }
}

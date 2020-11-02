<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_penilaian_id')
            ->constrained('kategori_penilaian')
            ->onDelete('cascade');
            $table->foreignId('pkl_id')->constrained('pkl');
            $table->unsignedInteger('nilai');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->unique(['kategori_penilaian_id','pkl_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('penilaian');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesertaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peserta', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('nis')->nullable()->unique();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->string('telepon', 12)->nullable();
            $table->string('foto')->nullable();
            $table->string('ayah')->nullable();
            $table->string('ibu')->nullable();
            $table->foreignId('program_keahlian_id')->nullable()
                ->constrained('program_keahlian')
                ->nullOnDelete();
            $table->foreignId('sekolah_id')->nullable()
                ->constrained('sekolah')
                ->nullOnDelete();
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
        Schema::dropIfExists('peserta');
    }
}

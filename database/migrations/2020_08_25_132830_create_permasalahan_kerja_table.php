<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermasalahanKerjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permasalahan_kerja', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->longText('topik');
            $table->boolean('status');
            $table->foreignId('pkl_id')->constrained('pkl')->cascadeOnDelete();
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('permasalahan_kerja');
    }
}

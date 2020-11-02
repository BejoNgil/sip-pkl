<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPermasalahan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_permasalahan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permasalahan_kerja_id')->constrained('permasalahan_kerja')->cascadeOnDelete();
            $table->longText('description');
            $table->foreignId('user_id')->constrained('user')->cascadeOnDelete();
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
        Schema::dropIfExists('detail_permasalahan');
    }
}

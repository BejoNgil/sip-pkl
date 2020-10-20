<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableBimbinganAddIsApproveAttribute extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bimbingan', function (Blueprint $table) {
            $table->boolean('is_approve')->default(false)->after('uraian');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bimbingan', function (Blueprint $table) {
            $table->dropColumn('is_approve');
        });
    }
}

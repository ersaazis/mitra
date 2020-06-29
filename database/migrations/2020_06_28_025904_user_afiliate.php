<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserAfiliate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('afiliate_id')->nullable();
            $table->bigInteger('money')->nullable();
            $table->string('kode_kupon')->nullable();
            $table->string('rekening')->nullable();
            $table->string('no_rekening')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(["afiliate_id","money","rekening","no_rekening"]);
        });
    }
}

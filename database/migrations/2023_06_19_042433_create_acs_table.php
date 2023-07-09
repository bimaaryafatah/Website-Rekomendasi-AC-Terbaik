<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->float('harga');
            $table->string('daya');
            $table->string('konsumsi_listrik');
            $table->string('tingkat_kebisingan');
            $table->string('garansi');
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
        Schema::dropIfExists('acs');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelaporansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelaporans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('cabang_id');
            $table->integer('cair')->nullable();
            $table->string('tempat')->nullable();
            $table->string('rceo')->nullable();
            $table->string('am')->nullable();
            $table->string('acfm')->nullable();
            $table->string('bm')->nullable();
            $table->string('crbmcbs')->nullable();
            $table->string('lain')->nullable();
            $table->longText('topik')->nullable();
            $table->longText('pembahasan')->nullable();
            // $table->softDeletes();
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
        Schema::dropIfExists('pelaporans');
    }
}

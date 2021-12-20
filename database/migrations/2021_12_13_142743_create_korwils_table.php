<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKorwilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('korwils', function (Blueprint $table) {
            $table->id();
            $table->string('tempat');
            $table->string('cabang');
            $table->string('rceo')->nullable();
            $table->string('am')->nullable();
            $table->string('acfm')->nullable();
            $table->string('bm')->nullable();
            $table->string('crbmcbs')->nullable();
            $table->string('lain')->nullable();
            $table->string('topik')->nullable();
            $table->string('pembahasan')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('korwils');
    }
}

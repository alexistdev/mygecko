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

            Schema::create('jawabans', function (Blueprint $table) {
                $table->id();
                $table->string('kode');
                $table->foreignId('basispengetahuan_id')
                    ->constrained('basispengetahuans')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
                $table->foreignId('user_id')
                    ->constrained('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
                $table->tinyInteger('jawaban');

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
        Schema::dropIfExists('jawabans');
    }
};

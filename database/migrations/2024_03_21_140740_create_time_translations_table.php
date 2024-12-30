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
        Schema::create('time_translations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();  $table->string('locale')->index();
            $table->string('name');
            $table->unique(['time_id', 'locale']);
            $table->foreignId('time_id')->references('id')->on('times')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_translations');
    }
};

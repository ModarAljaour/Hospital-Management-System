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
        Schema::create('receipt_account_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->string('description');
            $table->unique(['receipt_account_id', 'locale']);
            $table->foreignId('receipt_account_id')
                ->references('id')->on('receipt_accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receipt_account_translations');
    }
};

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
        Schema::create('deal_advertiser_agreement_constraints', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('operator');
            $table->string('value');
            $table->foreignId('deal_advertiser_agreement_id')
                ->constrained()
                ->onDelete('cascade')
                ->index('daaco_agreement_id_foreign');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deal_advertiser_agreement_constraints');
    }
};

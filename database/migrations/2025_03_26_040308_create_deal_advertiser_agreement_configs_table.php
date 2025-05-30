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
        Schema::create('deal_advertiser_agreement_configs', function (Blueprint $table) {
            $table->id();
            $table->json('payload')->nullable();
            $table->foreignId('deal_advertiser_agreement_id')
                ->constrained()
                ->onDelete('cascade')
                ->index('daacf_agreement_id_foreign');
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
        Schema::dropIfExists('deal_advertiser_agreement_configs');
    }
};

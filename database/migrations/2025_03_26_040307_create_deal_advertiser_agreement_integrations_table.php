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
        Schema::create('deal_advertiser_agreement_integrations', function (Blueprint $table) {
            $table->id();
            $table->json('ping_config')->nullable();
            $table->json('post_config')->nullable();
            $table->json('postback_config')->nullable();
            $table->foreignId('deal_advertiser_agreement_id')->constrained()->onDelete('cascade');            
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
        Schema::dropIfExists('deal_advertiser_agreement_integrations');
    }
};

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
        Schema::create('deal_assignments', function (Blueprint $table) {
            $table->id();
            $table->json('sent_object');
            $table->json('response')->nullable();
            $table->foreignId('deal_lead_id')->constrained()->onDelete('cascade');
            $table->foreignId('deal_advertiser_agreement_id')->constrained()->onDelete('cascade');
            $table->foreignId('deal_router_execution_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('deal_assignments');
    }
};

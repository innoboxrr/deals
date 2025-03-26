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
        Schema::create('deal_lead_tracking_events', function (Blueprint $table) {
            $table->id();
            $table->string('event');
            $table->string('status')->nullable();
            $table->json('data')->nullable();
            $table->foreignId('deal_lead_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('deal_lead_tracking_events');
    }
};

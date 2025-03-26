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
        Schema::create('deal_pixel_fires', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fired_at');
            $table->json('response')->nullable();
            $table->string('platform_type');
            $table->string('platform_id');
            $table->foreignId('deal_lead_tracking_event_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('deal_pixel_fires');
    }
};

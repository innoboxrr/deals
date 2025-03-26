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
        Schema::create('deal_advertiser_payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('processor');
            $table->string('processor_id');
            $table->timestamp('processor_date')->nullable();
            $table->string('status');
            $table->boolean('main')->default(false);
            $table->foreignId('deal_advertiser_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('deal_advertiser_payment_methods');
    }
};

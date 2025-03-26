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
        Schema::create('deal_gateways', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('active');
            $table->foreignId('deal_id')->constrained()->onDelete('cascade');
            $table->string('gateway_type');
            $table->unsignedBigInteger('gateway_id');            
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
        Schema::dropIfExists('deal_gateways');
    }
};

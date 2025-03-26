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
        Schema::create('deal_router_executions', function (Blueprint $table) {
            $table->id();
            $table->timestamp('start_execution');
            $table->timestamp('end_execution')->nullable();
            $table->json('assignment_log');
            $table->foreignId('deal_router_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('deal_router_executions');
    }
};

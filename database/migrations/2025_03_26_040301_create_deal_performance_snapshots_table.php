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
        Schema::create('deal_performance_snapshots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('time');
            $table->unsignedInteger('leads_generated')->default(0);
            $table->unsignedInteger('leads_assigned')->default(0);
            $table->decimal('avg_cpl', 10, 2)->nullable();
            $table->decimal('avg_conversion_rate', 5, 2)->nullable();
            $table->decimal('avg_roi', 6, 2)->nullable();
            $table->foreignId('deal_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('deal_performance_snapshots');
    }
};

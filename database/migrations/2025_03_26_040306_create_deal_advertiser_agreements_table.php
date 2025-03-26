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
        Schema::create('deal_advertiser_agreements', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('active');
            $table->json('payload')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->boolean('autorenewal')->default(false);
            $table->decimal('management_fee', 10, 2)->default(0);
            $table->decimal('budget', 12, 2);
            $table->decimal('estimate_cpl', 10, 2)->nullable();
            $table->decimal('net_budget', 12, 2)->default(0); // 0.3 * budget
            $table->decimal('budget_spent', 12, 2)->default(0);
            $table->unsignedInteger('leads_assigned')->default(0);
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
        Schema::dropIfExists('deal_advertiser_agreements');
    }
};

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
        Schema::table('deal_advertiser_agreements', function (Blueprint $table) {
            // Requiere doctrine/dbal para poder eliminar múltiples columnas
            $table->dropColumn([
                'payload',
                'start_date',
                'end_date',
                'autorenewal',
                'management_fee',
                'budget',
                'estimate_cpl',
                'net_budget',
                'budget_spent',
                'leads_assigned',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deal_advertiser_agreements', function (Blueprint $table) {
            $table->json('payload')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->boolean('autorenewal')->default(false);
            $table->decimal('management_fee', 10, 2)->default(0.00);
            $table->decimal('budget', 12, 2)->nullable();
            $table->decimal('estimate_cpl', 10, 2)->nullable();
            $table->decimal('net_budget', 12, 2)->default(0.00);
            $table->decimal('budget_spent', 12, 2)->default(0.00);
            $table->unsignedInteger('leads_assigned')->default(0);
        });
    }
};

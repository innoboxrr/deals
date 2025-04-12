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
        Schema::table('deal_performance_snapshots', function (Blueprint $table) {
            $table->decimal('daily_budget', 10, 2)->default(0)->after('time')->comment('Budget for the day');
            $table->decimal('daily_spent', 10, 2)->default(0)->after('daily_budget')->comment('Spent for the day');
            $table->decimal('lead_rejected', 10, 2)->default(0)->after('leads_assigned')->comment('Leads rejected for the day');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deal_performance_snapshots', function (Blueprint $table) {
            $table->dropColumn('daily_budget');
            $table->dropColumn('daily_spent');
            $table->dropColumn('lead_rejected');
        });
    }
};

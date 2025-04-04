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
        Schema::table('deal_advertiser_agreement_cpl_adjustments', function (Blueprint $table) {
            $table->renameColumn('deal_cpl_monitor_run_io', 'deal_performance_snapshot_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rename_deal_cpl_monitor_run_io_to_deal_performance_snapshots_tables');
    }
};

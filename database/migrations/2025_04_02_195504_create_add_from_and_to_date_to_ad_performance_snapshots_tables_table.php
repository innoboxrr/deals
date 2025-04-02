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
        Schema::table('ad_performance_snapshots_tables', function (Blueprint $table) {
            $table->dropColumn('timestamp');
            $table->unsignedBigInteger('from_date')->after('deal_ad_id')->nullable();
            $table->unsignedBigInteger('to_date')->after('from_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ad_performance_snapshots_tables', function (Blueprint $table) {
            $table->dropColumn('from_date');
            $table->dropColumn('to_date');
            $table->unsignedBigInteger('timestamp')->after('deal_ad_id')->nullable();
        });
    }
};

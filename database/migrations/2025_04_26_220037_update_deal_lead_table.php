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
        Schema::table('deal_leads', function (Blueprint $table) {
            $table->foreignId('deal_gateway_id')->nullable()->after('log');
            $table->dropColumn('payload');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deal_leads', function (Blueprint $table) {
            $table->json('payload')->after('status');
            $table->dropColumn('deal_gateway_id');
        });
    }
};

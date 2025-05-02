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
        Schema::table('deal_assignments', function (Blueprint $table) {
            $table->dropColumn(['sent_object', 'response']);
            $table->timestamp('assigned_at')->nullable()->after('deal_advertiser_agreement_id');
            $table->timestamp('delivered_at')->nullable()->after('assigned_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deal_assignments', function (Blueprint $table) {
            $table->json('sent_object')->nullable()->after('status');
            $table->json('response')->nullable()->after('sent_object');
        });
    }
};

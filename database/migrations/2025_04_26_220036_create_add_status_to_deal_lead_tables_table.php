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
            $table->string('status')->default('unprocessed')->after('id');
            $table->json('payload')->nullable()->after('status');
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
            $table->dropColumn('status');
            $table->dropColumn('payload');
        });
    }
};

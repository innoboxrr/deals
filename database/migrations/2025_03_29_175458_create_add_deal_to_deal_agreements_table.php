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

        Schema::dropIfExists('deal_deal_advertiser');

        Schema::table('deal_advertiser_agreements', function (Blueprint $table) {
            $table->foreignId('deal_id')->agfter('deal_advertiser_id')->constrained('deals')->onDelete('cascade');
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
            $table->dropForeign(['deal_id']);
            $table->dropColumn('deal_id');
        });

        Schema::create('deal_deal_advertiser', function (Blueprint $table) {
            $table->id();
            $table->foreignId('deal_id')->constrained()->onDelete('cascade');
            $table->foreignId('deal_advertiser_id')->constrained()->onDelete('cascade');
        });
    }
};

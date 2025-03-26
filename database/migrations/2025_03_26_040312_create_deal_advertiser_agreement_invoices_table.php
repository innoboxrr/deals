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
        Schema::create('deal_advertiser_agreement_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('pending');
            $table->date('from_date');
            $table->date('to_date');
            $table->decimal('management_fee', 10, 2)->default(0);
            $table->decimal('ad_spend', 12, 2)->default(0);
            $table->decimal('tax', 10, 2)->default(0);
            $table->decimal('total', 12, 2);
            $table->foreignId('deal_advertiser_id')->constrained()->onDelete('cascade');
            $table->foreignId('deal_advertiser_agreement_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('deal_advertiser_agreement_invoices');
    }
};

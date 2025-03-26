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
        Schema::create('deal_advertiser_agreement_cpl_adjustments', function (Blueprint $table) {
            $table->id();
            $table->decimal('before', 10, 2);
            $table->decimal('after', 10, 2);
            $table->uuid('deal_cpl_monitor_run_io');
            $table->foreignId('deal_advertiser_agreement_id')
                ->constrained()
                ->onDelete('cascade')
                ->index('daacad_agreement_id_foreign');
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
        Schema::dropIfExists('deal_advertiser_agreement_cpl_adjustments');
    }
};

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
        Schema::create('deal_advertiser_agreement_dailies', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('start_hour');
            $table->time('end_hour');
            $table->decimal('cpl', 10, 2);
            $table->decimal('budget', 12, 2);
            $table->decimal('spent', 12, 2)->default(0);
            $table->decimal('progress', 5, 2)->default(0);
            $table->unsignedInteger('leads_assigned')->default(0);
            $table->foreignId('deal_advertiser_agreement_id')
                ->constrained()
                ->onDelete('cascade')
                ->index('daad_agreement_id_foreign');
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
        Schema::dropIfExists('deal_advertiser_agreement_dailies');
    }
};

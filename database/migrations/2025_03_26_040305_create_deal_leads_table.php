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
        Schema::create('deal_leads', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('address')->nullable();
            $table->string('postalcode')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('utm_source')->nullable();
            $table->string('utm_medium')->nullable();
            $table->string('utm_campaign')->nullable();
            $table->string('utm_term')->nullable();
            $table->string('utm_content')->nullable();
            $table->text('url')->nullable();
            $table->text('referer')->nullable();
            $table->ipAddress('ip')->nullable();
            $table->string('platform')->nullable(); // facebook, google, affiliate, etc
            $table->string('traffic_id')->nullable(); // gclid, fbclid, clickidAff, etc
            $table->string('status')->default('new');
            $table->unsignedTinyInteger('score')->nullable();
            $table->decimal('cpl', 10, 2)->nullable(); // fijo o dinámico
            $table->timestamp('assigned_at')->nullable();
            $table->string('conversion_stage')->nullable();
            $table->foreignId('deal_gateway_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('is_test')->default(false);
            $table->json('other')->nullable();
            $table->json('duplicates_with')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('source_verified_at')->nullable();
            $table->integer('time_on_page')->nullable();
            $table->unsignedSmallInteger('interaction_count')->nullable();
            $table->unsignedTinyInteger('form_steps_completed')->nullable();
            $table->unsignedTinyInteger('interest_level')->nullable();
            $table->unsignedTinyInteger('fraud_risk')->nullable();            
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
        Schema::dropIfExists('deal_leads');
    }
};

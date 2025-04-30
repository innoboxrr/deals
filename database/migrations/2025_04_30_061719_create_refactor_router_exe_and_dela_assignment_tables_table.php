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
        Schema::table('deal_router_executions', function (Blueprint $table) {
            $table->json('delivery_log')->nullable()->after('assignment_log');
        });

        Schema::table('deal_assignments', function (Blueprint $table) {
            $table->dropForeign(['deal_router_execution_id']); 

            $table->string('status')->default('pending')->after('id');
            $table->foreignId('assignment_deal_router_execution_id')->nullable();
            $table->foreignId('delivery_deal_router_execution_id')->nullable();
        
            $table->dropColumn('deal_router_execution_id'); // ✅ ahora sí puedes eliminar la columna
        });
        
    }

    /**
     * Reverse the migrations. 
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deal_router_executions', function (Blueprint $table) {
            $table->dropColumn('delivery_log');
        });

        Schema::table('deal_assignments', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropForeign(['assignment_deal_router_execution_id']);
            $table->dropForeign(['delivery_deal_router_execution_id']);
            $table->dropColumn('assignment_deal_router_execution_id');
            $table->dropColumn('delivery_deal_router_execution_id');
            $table->foreignId('deal_router_execution_id')->nullable()->after('id');
            $table->index('deal_router_execution_id', 'deal_assignments_deal_router_execution_id_foreign');
        });
        
    }
};

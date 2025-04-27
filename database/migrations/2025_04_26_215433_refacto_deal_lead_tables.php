<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('deal_leads', function (Blueprint $table) {
            // 1. Dropear foreign keys manualmente antes de eliminar columnas
            $foreignKeys = [
                'deal_gateway_id',
            ];

            foreach ($foreignKeys as $column) {
                $foreignKeyName = $this->getForeignKeyName('deal_leads', $column);
                if ($foreignKeyName) {
                    $table->dropForeign($foreignKeyName);
                }
            }

            // 2. Eliminar columnas que no estén en la lista permitida
            $columns = Schema::getColumnListing('deal_leads');

            foreach ($columns as $column) {
                if (!in_array($column, ['id', 'created_at', 'updated_at', 'deleted_at'])) {
                    $table->dropColumn($column);
                }
            }

            // 3. Agregar nuevas columnas
            $table->unsignedBigInteger('lead_id')->nullable()->index()->after('id');
            $table->longText('log')->nullable()->after('lead_id');
        });
    }

    private function getForeignKeyName(string $table, string $column): ?string
    {
        // obtiene el nombre real de la foreign key en DB
        $connection = Schema::getConnection();
        $database = $connection->getDatabaseName();

        $result = DB::selectOne("
            SELECT CONSTRAINT_NAME
            FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
            WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ? AND COLUMN_NAME = ? AND REFERENCED_COLUMN_NAME IS NOT NULL
        ", [$database, $table, $column]);

        return $result?->CONSTRAINT_NAME;
    }

    public function down(): void
    {
        Schema::table('deal_leads', function (Blueprint $table) {
            $table->dropColumn(['lead_id', 'log']);
        });
    }
};

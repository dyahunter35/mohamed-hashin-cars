<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('branch_product', function (Blueprint $table) {
            $table->integer('new_quantity')->default(0)->after('total_quantity');
            $table->integer('used_quantity')->default(0)->after('new_quantity');
        });

        // Migrate existing data: recalculate from stock_histories
        DB::statement("
            UPDATE branch_product bp
            SET 
                new_quantity = COALESCE((
                    SELECT SUM(CASE WHEN type = 'increase' OR type = 'initial' THEN quantity_change ELSE -quantity_change END)
                    FROM stock_histories
                    WHERE stock_histories.product_id = bp.product_id
                    AND stock_histories.branch_id = bp.branch_id
                    AND stock_histories.condition = 'new'
                ), 0),
                used_quantity = COALESCE((
                    SELECT SUM(CASE WHEN type = 'increase' OR type = 'initial' THEN quantity_change ELSE -quantity_change END)
                    FROM stock_histories
                    WHERE stock_histories.product_id = bp.product_id
                    AND stock_histories.branch_id = bp.branch_id
                    AND stock_histories.condition = 'used'
                ), 0)
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('branch_product', function (Blueprint $table) {
            $table->dropColumn(['new_quantity', 'used_quantity']);
        });
    }
};

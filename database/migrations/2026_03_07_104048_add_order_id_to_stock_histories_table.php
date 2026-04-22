<?php

use App\Models\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('stock_histories', 'order_id')) {
            Schema::table('stock_histories', function (Blueprint $table) {
                $table->foreignIdFor(Order::class)->nullable()->after('product_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stock_histories', function (Blueprint $table) {
            $table->dropForeignIdFor(Order::class);
        });
    }
};

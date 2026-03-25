<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('user_inventory') && !Schema::hasColumn('user_inventory', 'quantity')) {
            Schema::table('user_inventory', function (Blueprint $table) {
                $table->unsignedInteger('quantity')->default(1)->after('item_id');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('user_inventory') && Schema::hasColumn('user_inventory', 'quantity')) {
            Schema::table('user_inventory', function (Blueprint $table) {
                $table->dropColumn('quantity');
            });
        }
    }
};

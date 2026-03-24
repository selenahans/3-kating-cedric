<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('users') && !Schema::hasColumn('users', 'starter_items_granted_at')) {
            Schema::table('users', function (Blueprint $table) {
                $table->timestamp('starter_items_granted_at')->nullable()->after('coins');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('users') && Schema::hasColumn('users', 'starter_items_granted_at')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('starter_items_granted_at');
            });
        }
    }
};

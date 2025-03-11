<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_best_seller')->default(false)->after('image');
            $table->boolean('is_popular_product')->default(false)->after('is_best_seller');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('is_best_seller');
            $table->dropColumn('is_popular_product');
            $table->dropColumn('deleted_at'); // Enable soft deletes

        });
    }
};

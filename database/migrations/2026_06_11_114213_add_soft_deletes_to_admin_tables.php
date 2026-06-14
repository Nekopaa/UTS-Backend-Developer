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
        Schema::table('produk_air', function (Blueprint $table) {
            $table->softDeletes();
        });
        
        Schema::table('kurir', function (Blueprint $table) {
            $table->softDeletes();
        });
        
        Schema::table('pelanggan', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produk_air', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        
        Schema::table('kurir', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        
        Schema::table('pelanggan', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};

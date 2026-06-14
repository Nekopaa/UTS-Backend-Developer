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
            $table->string('kapasitas', 50)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produk_air', function (Blueprint $table) {
            $table->enum('kapasitas', ['1500ml', '600ml', '300ml', '220ml'])->change();
        });
    }
};

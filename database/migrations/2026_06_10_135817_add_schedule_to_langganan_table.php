<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('langganan', function (Blueprint $table) {
            $table->string('hari_pengantaran')->nullable();
            $table->string('jam_pengantaran')->nullable();
            $table->unsignedInteger('durasi_bulan')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('langganan', function (Blueprint $table) {
            $table->dropColumn(['hari_pengantaran', 'jam_pengantaran', 'durasi_bulan']);
        });
    }
};

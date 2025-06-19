<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('role_permission_detail', function (Blueprint $table) {
            $table->id()->primary();
            $table->foreignId('role_id')->constrained('roles', 'role_id')->onDelete('cascade');
            $table->foreignId('permission_detail_id')->constrained('permission_detail', 'permission_detail_id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_permission_detail');
    }
};

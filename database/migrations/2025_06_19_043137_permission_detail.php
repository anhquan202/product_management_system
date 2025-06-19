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
        Schema::create('permission_detail', function (Blueprint $table) {
            $table->id('permission_detail_id')->primary();
            $table->foreignId('permission_module_id')
                ->constrained('permission_modules', 'permission_module_id')
                ->onDelete('cascade');
            $table->string('permission_key')->unique();
            $table->string('permission_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_detail');
    }
};

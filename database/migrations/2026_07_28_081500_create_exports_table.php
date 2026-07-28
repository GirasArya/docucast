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
        if (! Schema::hasTable('exports')) {
            Schema::create('exports', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->cascadeOnDelete();
                $table->string('exporter');
                $table->unsignedInteger('total_rows');
                $table->unsignedInteger('processed_rows')->default(0);
                $table->unsignedInteger('successful_rows')->default(0);
                $table->string('file_disk');
                $table->string('file_name')->nullable();
                $table->timestamp('completed_at')->nullable();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('export_failed_rows')) {
            Schema::create('export_failed_rows', function (Blueprint $table) {
                $table->id();
                $table->foreignId('export_id')->constrained()->cascadeOnDelete();
                $table->json('data');
                $table->text('validation_error')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('export_failed_rows');
        Schema::dropIfExists('exports');
    }
};

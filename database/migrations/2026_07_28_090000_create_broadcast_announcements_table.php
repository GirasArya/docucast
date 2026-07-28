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
        Schema::create('broadcast_announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type')->default('update'); // update, info, warning, success
            $table->text('content');
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('broadcast_user_reads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('announcement_id')->constrained('broadcast_announcements')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamp('read_at');
            $table->timestamps();

            $table->unique(['announcement_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('broadcast_user_reads');
        Schema::dropIfExists('broadcast_announcements');
    }
};

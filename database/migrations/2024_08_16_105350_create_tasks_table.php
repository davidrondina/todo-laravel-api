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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\User::class)->constrained()->cascadeOnDelete();
            $table->string('name')->default('Untitled task');
            $table->text('description')->nullable();
            $table->enum('priority', ['No Priority', 'Low Priority', 'Medium Priority', 'High Priority'])->default('No Priority')->nullable();
            $table->boolean('is_done')->default(false);
            $table->dateTime('due_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};

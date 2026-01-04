<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->uuid()
                ->primary();
            $table->foreignUuid('task_uuid')
                ->constrained(table: 'tasks', column: 'uuid')
                ->cascadeOnDelete();
            $table->string('description', length: 500)
                ->nullable();
            $table->unsignedSmallInteger('minutes_spent')
                ->nullable();
            $table->timestamp('performed_at')
                ->useCurrent();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};

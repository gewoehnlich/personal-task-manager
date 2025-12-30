<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->uuid()
                ->primary();
            $table->foreignUuid('user_uuid')
                ->constrained(table: 'users', column: 'uuid')
                ->cascadeOnDelete();
            $table->string('title', length: 100);
            $table->string('description', length: 500)
                ->nullable();
            $table->enum('stage', [
                'pending',
                'active',
                'done',
                'deleted',
            ]);
            $table->timestamp('deadline')
                ->nullable();
            $table->foreignUuid('project_uuid')
                ->nullable()
                ->constrained(table: 'projects', column: 'uuid')
                ->cascadeOnDelete();
            $table->boolean('debug')
                ->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};

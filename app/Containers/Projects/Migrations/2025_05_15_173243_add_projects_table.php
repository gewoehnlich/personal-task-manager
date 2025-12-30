<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->uuid()
                ->primary();
            $table->string('name', length: 100);
            $table->string('description', length: 500)
                ->nullable();
            $table->foreignUuid('user_uuid')
                ->constrained(table: 'users', column: 'uuid')
                ->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

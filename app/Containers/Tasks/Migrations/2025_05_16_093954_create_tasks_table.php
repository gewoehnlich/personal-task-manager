<?php

use App\Containers\Tasks\Values\DescriptionValue;
use App\Containers\Tasks\Values\TitleValue;
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
            $table->string('title', length: TitleValue::MAX_LENGTH);
            $table->string('description', length: DescriptionValue::MAX_LENGTH)
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
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};

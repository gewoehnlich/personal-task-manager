<?php

use App\Containers\Projects\Values\DescriptionValue;
use App\Containers\Projects\Values\TitleValue;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->uuid()
                ->primary();
            $table->string('title', length: TitleValue::MAX_LENGTH);
            $table->string('description', length: DescriptionValue::MAX_LENGTH)
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

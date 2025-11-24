<?php

namespace App\Containers\Projects\Models;

use App\Containers\Projects\Factories\ProjectFactory;
use App\Containers\Tasks\Models\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'deleted',
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    protected static function newFactory(): Factory
    {
        return ProjectFactory::new();
    }
}

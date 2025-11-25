<?php

namespace App\Containers\Tasks\Models;

use App\Containers\Bills\Models\Bill;
use App\Containers\Projects\Models\Project;
use App\Containers\Tasks\Factories\TaskFactory;
use App\Containers\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'stage',
        'deadline',
        'project_id',
        'deleted',
        'debug',
    ];

    protected $hidden = [
        //
    ];

    protected function casts(): array
    {
        return [
            //
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bills(): HasMany
    {
        return $this->hasMany(Bill::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    protected static function newFactory(): Factory
    {
        return TaskFactory::new();
    }
}

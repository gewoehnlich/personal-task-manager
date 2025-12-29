<?php

namespace App\Containers\Tasks\Models;

use App\Containers\Bills\Models\Bill;
use App\Containers\Projects\Models\Project;
use App\Containers\Tasks\Factories\TaskFactory;
use App\Containers\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Task extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'stage',
        'deadline',
        'project_id',
    ];

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

    protected function casts(): array
    {
        return [
            'deadline' => 'datetime',
            'debug'    => 'boolean',
        ];
    }

    protected static function newFactory(): Factory
    {
        return TaskFactory::new();
    }
}

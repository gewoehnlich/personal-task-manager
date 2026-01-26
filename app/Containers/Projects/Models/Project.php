<?php

namespace App\Containers\Projects\Models;

use App\Containers\Projects\Factories\ProjectFactory;
use App\Containers\Tasks\Models\Task;
use App\Containers\Users\Models\User;
use App\Ship\Values\DatetimeValue;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[UseFactory(ProjectFactory::class)]
final class Project extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'title',
        'description',
        'user_uuid',
    ];

    protected $casts = [
        'created_at' => 'datetime:' . DatetimeValue::FORMAT,
        'updated_at' => 'datetime:' . DatetimeValue::FORMAT,
        'deleted_at' => 'datetime:' . DatetimeValue::FORMAT,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}

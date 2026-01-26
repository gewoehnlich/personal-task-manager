<?php

namespace App\Containers\Tasks\Models;

use App\Containers\Bills\Models\Bill;
use App\Containers\Projects\Models\Project;
use App\Containers\Tasks\Factories\TaskFactory;
use App\Containers\Users\Models\User;
use App\Ship\Values\DatetimeValue;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[UseFactory(TaskFactory::class)]
final class Task extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'user_uuid',
        'title',
        'description',
        'stage',
        'deadline',
        'project_uuid',
    ];

    protected $casts = [
        'deadline'   => 'datetime:' . DatetimeValue::FORMAT,
        'created_at' => 'datetime:' . DatetimeValue::FORMAT,
        'updated_at' => 'datetime:' . DatetimeValue::FORMAT,
        'deleted_at' => 'datetime:' . DatetimeValue::FORMAT,
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
}

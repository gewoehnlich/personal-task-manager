<?php

namespace App\Containers\Projects\Models;

use App\Containers\Projects\Factories\ProjectFactory;
use App\Containers\Tasks\Models\Task;
use App\Containers\Users\Models\User;
use App\Ship\Values\DatetimeValue;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

#[UseFactory(ProjectFactory::class)]
/**
 * @property Carbon|null           $created_at
 * @property Carbon|null           $deleted_at
 * @property string|null           $description
 * @property Collection<int, Task> $tasks
 * @property int|null              $tasks_count
 * @property string                $title
 * @property Carbon|null           $updated_at
 * @property User                  $user
 * @property string                $user_uuid
 * @property string                $uuid
 *
 * @method static \App\Containers\Projects\Factories\ProjectFactory     factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereUserUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project withoutTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project withTrashed(bool $withTrashed = true)
 *
 * @mixin \Eloquent
 */
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function toArray(): array
    {
        return [
            'uuid'        => $this->uuid,
            'user_uuid'   => $this->user_uuid,
            'title'       => $this->title,
            'description' => $this->description,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
            'deleted_at'  => $this->deleted_at,
        ];
    }

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime:' . DatetimeValue::format(),
            'updated_at' => 'datetime:' . DatetimeValue::format(),
            'deleted_at' => 'datetime:' . DatetimeValue::format(),
        ];
    }
}

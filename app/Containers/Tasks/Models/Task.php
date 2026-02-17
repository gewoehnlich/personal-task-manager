<?php

namespace App\Containers\Tasks\Models;

use App\Containers\Bills\Models\Bill;
use App\Containers\Projects\Models\Project;
use App\Containers\Tasks\Factories\TaskFactory;
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

#[UseFactory(TaskFactory::class)]
/**
 * @property Collection<int, Bill> $bills
 * @property int|null              $bills_count
 * @property Carbon|null           $created_at
 * @property Carbon|null           $deadline
 * @property Carbon|null           $deleted_at
 * @property string|null           $description
 * @property Project|null          $project
 * @property string|null           $project_uuid
 * @property string                $stage
 * @property string                $title
 * @property Carbon|null           $updated_at
 * @property User                  $user
 * @property string                $user_uuid
 * @property string                $uuid
 *
 * @method static \App\Containers\Tasks\Factories\TaskFactory        factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereDeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereProjectUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereStage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereUserUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task withoutTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task withTrashed(bool $withTrashed = true)
 *
 * @mixin \Eloquent
 */
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
            'deadline'    => 'datetime:' . DatetimeValue::format(),
            'created_at'  => 'datetime:' . DatetimeValue::format(),
            'updated_at'  => 'datetime:' . DatetimeValue::format(),
            'deleted_at'  => 'datetime:' . DatetimeValue::format(),
        ];
    }
}

<?php

namespace App\Containers\Bills\Models;

use App\Containers\Bills\Factories\BillFactory;
use App\Containers\Tasks\Models\Task;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

#[UseFactory(BillFactory::class)]
/**
 * @property Carbon|null $created_at
 * @property Carbon|null $deleted_at
 * @property string|null $description
 * @property int|null    $minutes_spent
 * @property Carbon      $performed_at
 * @property Task        $task
 * @property string      $task_uuid
 * @property Carbon|null $updated_at
 * @property string      $uuid
 *
 * @method static \App\Containers\Bills\Factories\BillFactory        factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereMinutesSpent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill wherePerformedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereTaskUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill withoutTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill withTrashed(bool $withTrashed = true)
 *
 * @mixin \Eloquent
 */
final class Bill extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'task_uuid',
        'description',
        'minutes_spent',
        'performed_at',
    ];

    protected $hidden = [
        //
    ];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    protected function casts(): array
    {
        return [
            'performed_at' => 'datetime',
        ];
    }
}

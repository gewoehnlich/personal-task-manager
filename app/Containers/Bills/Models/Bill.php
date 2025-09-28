<?php

namespace App\Containers\Bills\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $task_id
 * @property string $description
 * @property int $time_spent
 * @property string $performed_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill wherePerformedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereTimeSpent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereUpdatedAt($value)
 * @mixin \Eloquent
 */
final class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'description',
        'time_spent',
        'performed_at',
    ];
}

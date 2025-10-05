<?php

namespace App\Containers\Bills\Models;

use App\Containers\Tasks\Models\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'description',
        'time_spent',
        'performed_at',
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

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}

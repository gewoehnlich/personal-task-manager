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

#[UseFactory(BillFactory::class)]
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

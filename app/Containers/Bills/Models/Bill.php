<?php

namespace App\Containers\Bills\Models;

use App\Containers\Bills\Factories\BillFactory;
use App\Containers\Tasks\Models\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
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
        'deleted',
    ];

    protected $hidden = [
        //
    ];

    protected function casts(): array
    {
        return [
            'performed_at' => 'datetime',
            'deleted' => 'boolean',
        ];
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    protected static function newFactory(): Factory
    {
        return BillFactory::new();
    }
}

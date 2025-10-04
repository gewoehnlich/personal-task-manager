<?php

namespace App\Containers\Tasks\Models;

use App\Containers\Bills\Models\Bill;
use App\Containers\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'stage',
        'deadline',
        'parent_id',
        'deleted',
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bill(): HasMany
    {
        return $this->hasMany(Bill::class);
    }
}

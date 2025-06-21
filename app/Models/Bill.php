<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'description',
        'time_spent',
        'performed_at'
    ];
}

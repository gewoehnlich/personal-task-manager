<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'userId',
        'title',
        'description',
        'taskStatus',
        'deadline',
    ];
}

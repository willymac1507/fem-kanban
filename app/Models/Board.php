<?php

namespace App\Models;

use Database\Factories\BoardFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Board extends Model
{
    /** @use HasFactory<BoardFactory> */
    use HasFactory;

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}

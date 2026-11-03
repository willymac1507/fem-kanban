<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    public function column(): BelongsTo
    {
        return $this->belongsTo(Board::class);
    }

    public function subtasks(): HasMany
    {
        return $this->hasMany(Subtask::class);
    }
}

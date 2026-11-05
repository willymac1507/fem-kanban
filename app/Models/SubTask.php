<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Unguarded;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Unguarded]
class SubTask extends Model
{
    public function Task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}

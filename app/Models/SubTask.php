<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubTask extends Model
{
    public function Task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}

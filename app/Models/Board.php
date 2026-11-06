<?php

namespace App\Models;

use Database\Factories\BoardFactory;
use Illuminate\Database\Eloquent\Attributes\Unguarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Unguarded]
class Board extends Model
{
    /** @use HasFactory<BoardFactory> */
    use HasFactory;

    public function columns(): HasMany
    {
        return $this->hasMany(Column::class);
    }
}

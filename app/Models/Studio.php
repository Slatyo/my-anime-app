<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Studio extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    public $fillable = [
        'name'
    ];

    /**
     * @return HasMany
     */
    public function animes(): HasMany
    {
        return $this->hasMany(Anime::class);
    }
}

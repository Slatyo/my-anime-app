<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyAnimeListAnimes extends Model
{
    use HasFactory;
    use HasTimestamps;

    public $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enums extends Model
{
    /** @use HasFactory<\Database\Factories\EnumsFactory> */
    use HasFactory;

    protected $table = 'enums';

    public function enumDefinition()
    {
        return $this->belongsTo(EnumDefinition::class);
    }
}

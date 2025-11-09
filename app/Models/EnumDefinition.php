<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnumDefinition extends Model
{
    /** @use HasFactory<\Database\Factories\EnumDefinitionFactory> */
    use HasFactory;

    public function enums()
    {
        return $this->hasMany(Enums::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistroInteres extends Model
{
    protected $table = 'registro_interes';

    protected $fillable = [
        'full_name',
        'cedula',
        'email',
        'household_size',
        'age_range',
    ];
}

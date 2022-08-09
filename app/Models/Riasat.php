<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riasat extends Model
{
    use HasFactory;

    public function departments()
    {
        return $this->hasMany(ArchDepartment::class,'riasat_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArchDepartment extends Model
{


    protected $primaryKey="id";
    protected $table="departments";
    protected $guarded="id";


    public function riasat()
    {
        return $this->belongsTo(Riasat::class,'riasat_id');
    }

}

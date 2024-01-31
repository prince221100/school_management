<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students_info extends Model
{
    use HasFactory;

    public function Admin(){
        return $this->belongsTo(Admin::class,'student_id','id');
    }
    public function Class_info(){
        return $this->belongsTo(Class_info::class,'class_name','id');
    }

}


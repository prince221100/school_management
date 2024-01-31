<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    public function getFirstnameAttribute($value){
        return ucfirst($value);
    }
    public function Class_data(){
        return $this->hasMany(Class_data::class,'teacher_id','id');
    }
    public function Students_info(){
        return $this->hasMany(Students_info::class,'student_id','id');

    }
}


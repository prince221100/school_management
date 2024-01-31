<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Class_info extends Model
{
    use HasFactory;
    public function Class_data(){
        return $this->hasMany(Class_data::class,'class_name','id');
    }
    public function Students_info(){
        return $this->hasMany(Students_info::class,'class_name','id');
    }
}

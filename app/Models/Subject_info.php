<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject_info extends Model
{
    use HasFactory;
    public function Class_data(){
        return $this->hasMany(Class_data::class,'subject_name','id');
    }
    public function Exam_Detail(){
        return $this->hasMany(Exam_Detail::class,'subject_name','id');

    }
    
}

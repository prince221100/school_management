<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Class_data extends Model
{
    use HasFactory;
    public function Admin(){
        return $this->belongsTo(Admin::class,'teacher_id','id');
    }
    public function Class_info(){
        return $this->belongsTo(Class_info::class,'class_name','id');
    }
    public function Subject_info(){
        return $this->belongsTo(Subject_info::class,'subject_name','id');
    }
}


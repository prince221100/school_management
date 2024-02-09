<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Auth\Authenticatable;

class Admin extends Model
{
    use HasApiTokens, HasFactory, Notifiable, Authenticatable;
    // protected $guard = 'admin';

    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];
    // protected $hidden = [
    //   'password', 'remember_token',
    // ];

    public function getFirstnameAttribute($value){
        return ucfirst($value);
    }
    public function Class_data(){
        return $this->hasMany(Class_data::class,'teacher_id','id');
    }
    public function Students_info(){
        return $this->hasMany(Students_info::class,'student_id','id');

    }
    public function Exam_Detail(){
        return $this->hasMany(Exam_Detail::class,'teacher_name','id');

    }
    public function Leave_info(){
        return $this->hasMany(Leave_Info::class,'user_id','id');

    }
}


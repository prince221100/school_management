<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave_Info extends Model
{
    use HasFactory;
    public function Admin(){
        return $this->belongsTo(Admin::class,'user_id','id');
    }
}

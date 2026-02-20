<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    public function classes(){
        return $this->hasMany(ClassName::class,'section_id');
    }

    public function teachers(){
        return $this->belongsToMany(Teacher::class,'section_teachers','section_id','teacher_id','id','id');
    }
}

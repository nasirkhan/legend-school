<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    public function designation(){
        return $this->belongsTo(Designation::class,'designation_id');
    }

    public function sections(){
        return $this->belongsToMany(Section::class,'section_teachers','teacher_id','section_id','id','id');
    }
}

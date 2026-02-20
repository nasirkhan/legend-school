<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    public function session(){
        return $this->belongsTo(AcademicSession::class,'session_id');
    }

    public function classInfo(){
        return $this->belongsTo(ClassName::class,'class_id');
    }

    public function components(){
        return $this->hasMany(ExamComponent::class,'exam_id');
    }

    public function papers(){
        return $this->hasMany(Paper::class,'exam_id');
    }


}

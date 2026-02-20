<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public function classInfo(){return $this->belongsTo(ClassName::class,'class_id');}

    public function session(){return $this->belongsTo(AcademicSession::class,'session_id');}

    public function photo(){return $this->belongsTo(StudentPhoto::class,'photo_id');}


//    public function subjects(){
//        return $this->belongsToMany(Subject::class,'student_class_subjects','student_id','subject_id');
//    }
}

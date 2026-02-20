<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassName extends Model
{
    use HasFactory;

    public function subjects(){
        return $this->hasMany(Subject::class,'class_id');
    }

    public function classSubjects(){
        return $this->belongsToMany(Subject::class,'subject_classes','class_id','subject_id','id','id');
    }

    public function section(){
        return $this->belongsTo(Section::class,'section_id');
    }

    public function labFee(){
        return $this->hasOne(LabFee::class,'class_id');
    }

}

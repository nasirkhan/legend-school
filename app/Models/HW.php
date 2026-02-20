<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HW extends Model
{
    use HasFactory;

    public function classInfo(){
        return $this->belongsTo(ClassName::class,'class_id');
    }

    public function subject(){
        return $this->belongsTo(Subject::class,'subject_id');
    }

    public function studentHomeWorks(){
        return $this->hasMany(StudentHW::class,'hw_id');
    }
}

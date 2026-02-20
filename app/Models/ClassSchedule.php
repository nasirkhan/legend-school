<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSchedule extends Model
{
    use HasFactory;

    public function day(){
        return $this->belongsTo(Day::class,'day_id');
    }

    public function period(){
        return $this->belongsTo(Period::class,'period_id');
    }

    public function className(){
        return $this->belongsTo(ClassName::class,'class_id');
    }

    public function subject(){
        return $this->belongsTo(Subject::class,'subject_id');
    }
}

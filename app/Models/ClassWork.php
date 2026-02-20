<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassWork extends Model
{
    use HasFactory;

    public function subject(){
        return $this->belongsTo(Subject::class,'subject_id');
    }

    public function classInfo()
    {
        return $this->belongsTo(ClassName::class,'class_id');

    }
}

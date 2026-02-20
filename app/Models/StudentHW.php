<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentHW extends Model
{
    use HasFactory;

    public function hw(){
        return $this->belongsTo(HW::class,'hw_id');
    }

    public function student(){
        return $this->belongsTo(Student::class,'student_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherAttendance extends Model
{
    use HasFactory;

    public function month(){
        return $this->belongsTo(Month::class,'row_id');
    }

    public function student(){
        return $this->belongsTo(Student::class,'student_id');
    }
}

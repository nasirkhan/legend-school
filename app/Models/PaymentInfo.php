<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentInfo extends Model
{
    use HasFactory;

    public function payments(){
        return $this->hasMany(Payment::class,'payment_info_id');
    }

    public function student(){
        return $this->belongsTo(Student::class,'student_id');
    }

    public function classInfo(){
        return $this->belongsTo(ClassName::class,'class_id');
    }
}

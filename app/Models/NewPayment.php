<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewPayment extends Model
{
    use HasFactory;

    public function student(){
        return $this->belongsTo(Student::class,'student_id');
    }

    public function class(){
        return $this->belongsTo(ClassName::class,'class_id');
    }

    public function studentPaymentItems(){
        return $this->hasMany(StudentPaymentItem::class,'payment_id');
    }

    public function methods(){
        return $this->hasMany(NewPaymentMethod::class,'new_payment_id');
    }
}

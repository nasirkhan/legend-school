<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPaymentItem extends Model
{
    use HasFactory;

    protected $fillable = ['payment_id','payment_date','status'];

    public function student(){
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function item(){
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function month(){
        return $this->belongsTo(Month::class, 'month_id');
    }

    public function class(){
        return $this->belongsTo(ClassName::class, 'class_id');
    }

    public function payment()
    {
        return $this->belongsTo(NewPayment::class, 'payment_id');

    }
}

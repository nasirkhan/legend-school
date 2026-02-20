<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['payment_date','status'];

    public function student(){
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function classInfo(){
        return $this->belongsTo(ClassName::class, 'class_id');
    }

//    public function paymentInfo(){
//        return $this->hasOne(PaymentInfo::class, 'invoice_id');
//    }
    public function activeDetails(){
        return $this->hasMany(InvoiceDetails::class, 'invoice_id')->where( 'status', 1);
    }

    public function deletedDetails(){
        return $this->hasMany(InvoiceDetails::class, 'invoice_id')->where( 'status', 2);
    }

    public function allDetails(){
        return $this->hasMany(InvoiceDetails::class, 'invoice_id');
    }

    public function activeNote(){
        return $this->hasOne(InvoiceNote::class, 'invoice_id')->where( 'status', 1);
    }

    public function deletedNotes(){
        return $this->hasMany(InvoiceNote::class, 'invoice_id')->where( 'status', 2);
    }

    public function allNotes(){
        return $this->hasMany(InvoiceNote::class, 'invoice_id');
    }

    public function payments(){
        return $this->hasMany(Payment::class, 'invoice_id');
    }

    public function fine(){
        return $this->hasOne(Fine::class, 'invoice_id');
    }

    public function previousDue(){
        return $this->hasOne(PreviousDue::class, 'invoice_id');
    }
}

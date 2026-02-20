<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model
{
    use HasFactory;

    public function classItem()
    {
        return $this->belongsTo(ClassItem::class, 'class_item_id');
    }

    public function month(){
        return $this->belongsTo(Month::class, 'reference_id');
    }
}

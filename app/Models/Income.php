<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    public function month(){
        return $this->belongsTo(Month::class,'month_id');
    }

    public function item(){
        return $this->belongsTo(ExpenseItem::class,'item_id');
    }

    public function account(){
        return $this->belongsTo(Beneficiary::class,'account_id');
    }
}

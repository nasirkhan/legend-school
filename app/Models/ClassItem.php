<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassItem extends Model
{
    use HasFactory;

    public function item(){
        return $this->belongsTo(Item::class,'item_id')->select('id','name','used_for','billing_cycle');
    }

    public function class(){
        return $this->belongsTo(ClassName::class,'class_id');
    }
}

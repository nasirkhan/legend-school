<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoutine extends Model
{
    use HasFactory;

    public function classInfo(){
        return $this->belongsTo(ClassName::class,'class_id');
    }
}

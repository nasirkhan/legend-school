<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultMeta extends Model
{
    use HasFactory;

    function exam(){
        return $this->belongsTo(Exam::class,'exam_id');
    }
}

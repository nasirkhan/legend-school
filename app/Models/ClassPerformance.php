<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\DocBlock\Tag;

class ClassPerformance extends Model
{
    use HasFactory;

    public function tag(){
        return $this->belongsTo(ClassPerformanceTag::class,'tag_id');
    }

    public function teacher(){
        return $this->belongsTo(Teacher::class,'teacher_id');
    }
}

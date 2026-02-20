<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transcript extends Model
{
    use HasFactory;

    public function rules(){
        return $this->hasMany(TranscriptRule::class,'transcript_id');
    }

    public function exam(){
        return $this->belongsTo(Exam::class,'exam_id');
    }
}

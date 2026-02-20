<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateStudent extends Model
{
    use HasFactory;

    public function subjects(){
        return $this->hasMany(TranscriptSubject::class,'student_id');
    }
}

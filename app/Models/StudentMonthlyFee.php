<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentMonthlyFee extends Model
{
    use HasFactory;

    public function class(){
        return $this->belongsTo(ClassName::class, 'class_id');
    }
}

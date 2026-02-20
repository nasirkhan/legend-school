<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BioAttendance extends Model
{
    use HasFactory;

    protected $fillable = ['device_sn','user_id','verify_mode','att_state','timestamp'];
}

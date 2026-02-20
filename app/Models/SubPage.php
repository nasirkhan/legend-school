<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubPage extends Model
{
    use HasFactory;

    public function mainPage(){
        return $this->belongsTo(Page::class,'page_id');
    }
}

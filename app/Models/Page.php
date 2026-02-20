<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    public function menu(){
        return $this->belongsTo(Menu::class,'menu_id');
    }

    public function subPages(){
        return $this->hasMany(SubPage::class,'page_id')->where('status','=',1);
    }
}

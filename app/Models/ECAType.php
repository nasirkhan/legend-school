<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ECAType extends Model
{
    use HasFactory;

    public function items(){
        return $this->hasMany(ECAItem::class,'eca_type_id');
    }
}

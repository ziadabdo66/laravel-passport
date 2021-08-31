<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tourism extends Model
{
    protected $table='tourism';
    protected $fillable=['email','password','username','city','photo','created_at','updated_at'];
    public function getPhotoAttribute($value){
        return ($value!==null)?asset('asset/images/tourism/'.$value):"";
    }
}

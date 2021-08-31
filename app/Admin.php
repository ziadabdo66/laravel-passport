<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
class Admin extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table='admins';
    protected $fillable = [
        'name', 'email', 'password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function books(){
        return $this->belongsToMany(Book::class,'admin_book');
    }
}

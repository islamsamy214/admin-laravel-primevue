<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ]; //end of hidden

    protected $appends = [
        'image_path'
    ]; //end of appends

    protected $casts = [
        'email_verified_at' => 'datetime',
    ]; //end of casts

    public function getImagePathAttribute()
    {
        return asset($this->image);
    } //end of retreving image directly
}

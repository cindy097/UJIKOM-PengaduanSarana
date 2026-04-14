<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    protected $fillable = [
        'name',
        'role',
        'class',
        'password',
    ];

    public function aspirations() {
        return $this->hasMany(Aspiration::class);
    }

    public function feedbacks() {
        return $this->hasMany(Feedback::class);
    }

}
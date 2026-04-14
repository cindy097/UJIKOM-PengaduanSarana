<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';
    
    protected $fillable = [
        'response', 'aspiration_id', 'user_id'
    ];

    public function aspiration() {
        return $this->belongsTo(ASpiration::class);
    }

    public function admin() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
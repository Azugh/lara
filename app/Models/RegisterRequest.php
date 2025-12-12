<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegisterRequest extends Model
{
    //
    public $fillable = ['name', 'email', 'message', 'department', 'tel',];

    protected $hidden = ['isVerified'];

    protected function casts(): array
    {
        return [
            'verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}

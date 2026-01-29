<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property \Illuminate\Support\HigherOrderCollectionProxy|mixed $password
 */
class RegisterRequest extends Model
{
    use HasFactory;
    //
    public $fillable = ['name', 'email', 'message', 'department', 'tel', 'isVerified', 'password', 'pending_verification'];

    protected $hidden = ['isVerified', 'password',];

    protected function casts(): array
    {
        return [
            'verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}

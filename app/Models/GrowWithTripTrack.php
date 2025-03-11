<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class GrowWithTripTrack extends Authenticatable
{
    use HasFactory;
    protected $table = 'grow_with_triptrack';
    protected $fillable = ['first_name', 'email', 'mobile', 'password'];
    protected $hidden = ['password'];
}

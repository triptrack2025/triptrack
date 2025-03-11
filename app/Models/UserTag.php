<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;


class UserTag extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'user_id',
        'tag_id',
        'qr_code',
        'valuable_type',
        'bag_description',
        'display_name',
        'bag_brand',
        'tag_image',
        'tag_active_date',
        'tag_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function getFormattedTagActiveDateAttribute()
    {
        return Carbon::parse($this->tag_active_date)->format('d M, Y');
    }


   
}


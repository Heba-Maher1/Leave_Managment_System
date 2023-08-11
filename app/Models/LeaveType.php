<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(user::class);
    }
}

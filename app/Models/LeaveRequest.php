<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class LeaveRequest extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ['user_id', 'leave_type_id', 'start_at', 'end_at', 'reason', 'status'];

    protected $dates = ['start_at', 'end_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'sender_id',
        'recipient_id',
        'body'
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    public function scopeBetween($query, $userA, $userB)
    {
        return $query->where(function ($q) use ($userA, $userB) {
            $q->where('sender_id', $userA)
                ->where('recipient_id', $userB);
        })->orWhere(function ($q) use ($userA, $userB) {
            $q->where('sender_id', $userB)
                ->where('recipient_id', $userA);
        });
    }
}

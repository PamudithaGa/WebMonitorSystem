<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class website extends Model
{
    use HasFactory;
    protected $table = 'website';
    protected $fillable = [
        'website_id',
        'url',
        'name',
        'client',
        'status',
        'last_checked',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


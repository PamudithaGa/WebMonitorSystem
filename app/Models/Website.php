<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class website extends Model
{
    use HasFactory;

    // Define the table name (optional if the table name follows Laravel's convention)
    protected $table = 'website';

    // Define the fillable fields (mass assignable)
    protected $fillable = [
        'website_id',
        'url',
        'name',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    



}

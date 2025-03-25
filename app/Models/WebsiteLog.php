<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'website_id',
        'status',
        'error_details',
        'logged_at'
    ];

    public $timestamps = false;

    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}

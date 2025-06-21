<?php

// app/Models/SeoResult.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Website;

class SeoResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'website_id',
        'score',
        'issues',
        'recommendations',
        'checked_at',
    ];

    protected $casts = [
        'issues' => 'array',
        'recommendations' => 'array',
        'checked_at' => 'datetime',
    ];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}

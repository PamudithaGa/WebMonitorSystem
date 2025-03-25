<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SslCertificate extends Model
{
    use HasFactory;
    protected $table = 'ssl_certificates';

    protected $fillable = ['certificate_id', 'website_id', 'expiry_date', 'alert_sent'];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    

    protected $casts = [
        'expiry_date' => 'datetime',
    ];
}

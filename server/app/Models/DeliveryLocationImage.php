<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryLocationImage extends Model
{
    use HasFactory;
    protected $table = 'delivery_location_image';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'image_url',
    ];

    protected $casts = [
        'deletion_date' => 'datetime',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

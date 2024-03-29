<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoopDrones extends Model
{
    use HasFactory;
    protected $table = 'coop_drones';
    protected $primaryKey = 'id';
    protected $fillable = [
        'drone_type_id',
        'coop_user_id',
        'operating_time',
        'purchase_date',
        'drone_status',
        'possession_or_loan',
        'lending_period',
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'lending_period' => 'date',
        'deletion_date' => 'datetime',
    ];
    public function drone_type()
    {
        return $this->belongsTo(DroneType::class);
    }
    public function coop_user()
    {
        return $this->belongsTo(CoopUser::class);
    }
}

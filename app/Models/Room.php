<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory, HasUuid;

    protected $table = "rooms";
    protected $primaryKey = "id";

    protected $fillable = [
        'uuid',
        'room',
        'capacity',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'room_uuid', 'uuid');
    }
}

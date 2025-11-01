<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory, HasUuid;

    protected $table = "bookings";
    protected $primaryKey = "id";

    protected $fillable = [
        'uuid',
        'name',
        'email',
        'department_uuid',
        'room_uuid',
        'date',
        'start_time',
        'end_time',
        'description',
        'status',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_uuid', 'uuid');
    }

    public function rooms()
    {
        return $this->belongsTo(Room::class, 'room_uuid', 'uuid');
    }
}

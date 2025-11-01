<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory, HasUuid;

    protected $table = "departments";
    protected $primaryKey = "id";

    protected $fillable = [
        'uuid',
        'department'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'department_uuid', 'uuid');
    }
}

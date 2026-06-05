<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id', 'border_number', 'roll_number', 'name',
        'department', 'session', 'phone', 'room_id'
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function room() { return $this->belongsTo(Room::class); }
    public function seat() { return $this->hasOne(Seat::class); }
    public function fees() { return $this->hasMany(Fee::class); }
    public function meals() { return $this->hasMany(Meal::class); }
    public function complaints() { return $this->hasMany(Complaint::class); }
}
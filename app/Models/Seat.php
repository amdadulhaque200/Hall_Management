<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    protected $fillable = ['room_id', 'seat_number', 'student_id', 'status'];

    public function room() { return $this->belongsTo(Room::class); }
    public function student() { return $this->belongsTo(Student::class); }
}
<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['room_number', 'floor', 'capacity'];

    public function students() { return $this->hasMany(Student::class); }
    public function seats() { return $this->hasMany(Seat::class); }
}
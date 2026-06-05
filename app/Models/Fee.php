<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $fillable = ['student_id', 'month', 'year', 'amount', 'status', 'paid_at'];

    public function student() { return $this->belongsTo(Student::class); }
}
<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = ['student_id', 'subject', 'message', 'status', 'admin_reply'];

    public function student() { return $this->belongsTo(Student::class); }
}
<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $fillable = ['title', 'body', 'created_by', 'emailed'];

    public function author() { return $this->belongsTo(User::class, 'created_by'); }
}
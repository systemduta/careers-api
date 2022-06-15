<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'intern_id','nama_or','posisi_or','periode_or','achievement_or'
    ];

    public function intern()
    {
        return $this->belongsTo(Internship::class);
    }
}

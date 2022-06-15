<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magang extends Model
{
    use HasFactory;

    protected $fillable = [
        'intern_id','nama_ma','posisi_ma','periode_ma','achievement_ma','benefit_ma'
    ];

    public function intern()
    {
        return $this->belongsTo(Internship::class);
    }
}

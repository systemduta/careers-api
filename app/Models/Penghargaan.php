<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penghargaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'intern_id','nama_p','juara_p','lingkup_p','tahun_p'
    ];

    public function intern()
    {
        return $this->belongsTo(Internship::class);
    }
}

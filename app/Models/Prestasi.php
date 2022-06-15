<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_id','nama_p','juara_p','lingkup_p','tahun_p'
    ];

    public function fulltime()
    {
        return $this->belongsTo(Fulltime::class);
    }
}

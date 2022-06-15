<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_id','hubungan','nama_kel','pendidikan_kel','pekerjaan_kel'
    ];

    public function full()
    {
        return $this->belongsTo(Fulltime::class);
    }
}

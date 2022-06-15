<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_id','perusahaan','posisi_k','periode_k','gaji_k','resign_k'
    ];

    public function full()
    {
        return $this->belongsTo(Fulltime::class);
    }
}

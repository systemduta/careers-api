<?php

namespace App\Models;

use App\Models\Fulltime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Education extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function fulltime()
    {
        return $this->belongsTo(Fulltime::class);
    }
}

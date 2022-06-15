<?php

namespace App\Models;

use App\Models\Fulltime;
use App\Models\Internship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Achievement extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function fulltime()
    {
        return $this->belongsTo(Fulltime::class);
    }

    public function intern()
    {
        return $this->belongsTo(Internship::class);
    }
}

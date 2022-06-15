<?php

namespace App\Models;

use App\Models\Magang;
use App\Models\Participant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Internship extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    public function magangs()
    {
        return $this->hasMany(Magang::class);
    }
}

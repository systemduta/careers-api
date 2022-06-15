<?php

namespace App\Models;

use App\Models\Family;
use App\Models\Education;
use App\Models\Participant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fulltime extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    public function families()
    {
        return $this->hasMany(Family::class);
    }

    public function educations() {
        return $this->hasMany(Education::class);
    }
}

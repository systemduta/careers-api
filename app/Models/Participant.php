<?php

namespace App\Models;

use App\Models\Fulltime;
use App\Models\Internship;
use App\Models\Achievement;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Participant extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function fulltime()
    {
        return $this->belongsTo(Fulltime::class);
    }

    public function internship()
    {
        return $this->belongsTo(Internship::class);
    }

    public function organizations()
    {
        return $this->hasMany(Organization::class);
    }

    public function achievements()
    {
        return $this->hasMany(Achievement::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    use HasFactory;

    protected $fillable = [
        'recruitment_id','place_birth','name','date_birth','address_domicili','gender','email','resources','commitment','hope',
        'ig','fb','twiter','pt','jurusan','semester','cv','fortofolio','sertificate','foto','address_domicili'
    ];

    public function recruitment()
    {
        return $this->belongsTo(Recruitment::class);
    }

    public function magang()
    {
        return $this->hasMany(Magang::class);
    }

    public function organisasi()
    {
        return $this->hasMany(Organization::class);
    }

    public function prestasi()
    {
        return $this->hasMany(Penghargaan::class);
    }
}

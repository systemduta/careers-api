<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fulltime extends Model
{
    use HasFactory;

    protected $fillable = [
        'recruitment_id','name','place_birth','date_birth','gender','email','age','address_domicili',
        'address_ktp','nik','religion','status','blood','gaji','pt','jurusan','years','ipk','cv',
        'portofolio','sertificate','foto'
    ];

    public function recruitment()
    {
        return $this->belongsTo(Recruitment::class);
    }

    public function keluarga()
    {
        return $this->hasMany(Keluarga::class);
    }

    public function prestasi()
    {
        return $this->hasMany(Prestasi::class);
    }
}

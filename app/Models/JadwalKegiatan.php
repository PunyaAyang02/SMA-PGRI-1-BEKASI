<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class JadwalKegiatan extends Model
{
    use HasFactory;

    protected $guarded =[
        'id'
    ];

    
    // public function setTanggalAwalAttribute()
    // {
    //     return Carbon::parse($this->attributes['tanggal_awal'])
    //     ->translatedFormat('d F Y');
    // }
    // public function setTanggalAkhirAttribute()
    // {
    //     return Carbon::parse($this->attributes['tanggal_akhir'])
    //     ->translatedFormat('d F Y');
    // }
    




}

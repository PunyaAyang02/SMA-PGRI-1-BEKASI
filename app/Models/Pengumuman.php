<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumuman';
    
    protected $guarded = [
        'id'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}

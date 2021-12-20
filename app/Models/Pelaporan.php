<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pelaporan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

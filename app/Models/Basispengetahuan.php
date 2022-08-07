<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basispengetahuan extends Model
{
    use HasFactory;
    protected $fillable = ['penyakit_id','gejala_id'];

    public function penyakit(){
        return $this->belongsTo(Penyakit::class);
    }

    public function gejala(){
        return $this->belongsTo(Gejala::class);
    }
}

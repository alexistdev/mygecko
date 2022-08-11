<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;
    protected $fillable = ['kode','user_id','gejala_id','jawaban'];

    public function basis(){
        return $this->belongsTo(Basispengetahuan::class,'basispengetahuan_id','id')->with('gejala');
    }
}

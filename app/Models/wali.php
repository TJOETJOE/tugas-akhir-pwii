<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wali extends Model
{
   use HasFactory;
   protected $table ='walis';
   protected $fillable = [
    'nama_wali',
    'pekerjaan',
    'id_siswa'
   ];
   public function siswa()
   {
    return $this->belongsTo(SiswaModel::class, 'id_siswa', 'id');
   }
}

<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SiswaModel extends Model
{
    use HasFactory;
    protected $table = 'siswa';

    public function wali()
    {
        return $this->hasOne(Wali::class, 'id_siswa', 'id');
    }
}

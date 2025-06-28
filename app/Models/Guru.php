<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru';

    protected $fillable = ['nama_guru', 'email', 'alamat', 'matpel'];

    public function matpels(): BelongsToMany
    {
        return $this->belongsToMany(Matpel::class, 'guru_matpel', 'guru_id', 'matpel_id');
    }
}
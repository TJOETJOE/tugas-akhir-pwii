<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Matpel extends Model
{
    use HasFactory;

    protected $table = 'matpel';

    public function gurus(): BelongsToMany
    {
        return $this->belongsToMany(Guru::class, 'guru_matpel', 'matpel_id', 'guru_id');
    }
}
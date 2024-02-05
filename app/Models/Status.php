<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';
    protected $fillable = [
        'name', 'desc',
    ];

    // Definisi relasi dengan DocUpm
    public function docUpm()
    {
        return $this->hasMany(DocUpm::class);
    }
}

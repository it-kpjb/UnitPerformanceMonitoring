<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relation\HasMany;

class Status extends Model
{
    protected $table = 'status';
    protected $fillable = [
        'name',
        'desc',
        'public_view'
    ];

    // Definisi relasi dengan DocUpm
    public function docUpm()
    {
        return $this->hasMany(DocUpm::class);
    }
}

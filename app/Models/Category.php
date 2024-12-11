<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relation\HasMany;
use App\Models\DocUpm;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'name', 'desc',
    ];

    // Definisi relasi dengan DocUpm
    public function docUpm()
    {
        return $this->hasMany(DocUpm::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relation\HasMany;
use App\Models\DocUpm;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use Sluggable;
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'desc',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    // Definisi relasi dengan DocUpm
    public function docUpm()
    {
        return $this->hasMany(DocUpm::class);
    }
}

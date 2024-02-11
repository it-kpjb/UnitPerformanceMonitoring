<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocUpm extends Model
{
    // protected $table = 'doc_upm';
    protected $fillable = [
        'dm_number','subject','user', 'tgldoc', 'status_id',  'attachment_path',
    ];

    protected $dates = ['tgldoc'];
    
    // Definisi relasi dengan Status
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    public function files()
    {
        return $this->hasMany(DocFile::class);
    }
}

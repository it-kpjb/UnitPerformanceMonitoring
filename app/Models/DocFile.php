<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocFile extends Model
{
    protected $fillable = [
        'doc_upm_id', 'attachment_path'
    ];

    public function docUpm()
    {
        return $this->belongsTo(DocUpm::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    /** @use HasFactory<\Database\Factories\MediaFactory> */
    use HasFactory;

    protected $fillable = [
        'file_name',
        'file_path',
        'file_size',
        'mime_type',
        'media_type',
        'title',
        'caption',
        'alt_text',
    ];
}
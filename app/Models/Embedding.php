<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Embedding extends Model
{
    use HasFactory;
    protected $table = 'embeddings';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'fileName',
        'description',
    ];
    public function styles()
    {
        return $this->hasMany(Style::class, 'style_embedding');
    }
    public function images()
    {
        return $this->hasMany(Image::class, 'image_embedding');
    }
}

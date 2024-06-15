<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lora extends Model
{
    use HasFactory;
    protected $table = 'loras';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'fileName',
        'description',
    ];
    public function images()
    {
        return $this->hasMany(Image::class, 'image_lora');
    }
}

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
        'description',
        'user_id',
    ];
    public function styles()
    {
        return $this->hasMany(Style::class, 'style_lora');
    }
    public function images()
    {
        return $this->hasMany(Image::class, 'image_lora');
    }
}

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
        'user_id', // 'user_id' is a foreign key to the 'id' column in the 'users' table
        'name',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function styles()
    {
        return $this->hasMany(Style::class, 'style_lora');
    }
    public function images()
    {
        return $this->hasMany(Image::class, 'image_lora');
    }
}

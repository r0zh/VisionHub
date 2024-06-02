<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $table = 'tags';

    protected $primaryKey = 'id';
    protected $fillable = [
        'name'
    ];

    public function images() {
        
        return $this->belongsToMany(Image::class, 'image_tag');
    }
    public function user() {
        
        return $this->belongsTo(User::class);
    }
}

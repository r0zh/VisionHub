<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkpoint extends Model
{
    use HasFactory;
    protected $table = 'checkpoints';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'description',
        'fileName',
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }
    public function styles()
    {
        return $this->hasMany(Style::class);
    }
}

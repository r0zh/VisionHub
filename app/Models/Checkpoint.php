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
        'fileName',
        'description',
        'steps',
        'cfg',
        'sampler_name',
        'scheduler',
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

}

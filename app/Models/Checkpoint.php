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
        'user_id',
        'name'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function images() {
        return $this->hasMany(Image::class);
    }
    public function styles() {
        return $this->hasMany(Style::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Image
 * 
 * This class represents an image model.
 */
class Image extends Model
{
    use HasFactory;

    protected $table = 'image';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id', // 'user_id' is a foreign key to the 'id' column in the 'users' table
        'style_id',
        'seed',
        'name',
        'description',
        'path',
        'positivePrompt',
        'negativePrompt',
        'public',
        'style'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function style()
    {
        return $this->belongsTo(Style::class);
    }
    public function owner()
    {
        return $this->belongsTo(User::class, 'user')->first();
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'images_tag');
    }
}

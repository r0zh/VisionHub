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

    protected $table = 'images';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id', // 'user_id' is a foreign key to the 'id' column in the 'users' table
        'style_id',
        'checkpoint_id',
        'seed',
        'name',
        'description',
        'path',
        'positivePrompt',
        'negativePrompt',
        'public'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function checkpoint()
    {
        return $this->belongsTo(Checkpoint::class);
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
        return $this->belongsToMany(Tag::class, 'image_tag');
    }
    public function imageLoras()
    {
        return $this->hasMany(ImageLora::class);
    }
    public function imageEmbeddings()
    {
        return $this->hasMany(ImageEmbedding::class);
    }
    public function loras()
    {
        return $this->belongsToMany(Lora::class, 'image_lora');
    }
    public function embeddings()
    {
        return $this->belongsToMany(Embedding::class, 'image_embedding');
    }
}

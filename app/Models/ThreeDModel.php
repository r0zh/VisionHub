<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThreeDModel extends Model
{
    use HasFactory;

    protected $table = 'three_d_models';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id', // 'user_id' is a foreign key to the 'id' column in the 'users' table
        'name',
        'description',
        'path',
        'prompt',
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
    public function loras()
    {
        return $this->belongsToMany(Lora::class, 'image_lora');
    }
    public function embeddings()
    {
        return $this->belongsToMany(Embedding::class, 'image_embedding');           
    }
}

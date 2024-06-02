<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    use HasFactory;
    protected $table = 'styles';

    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'name',
        'checkpoint_id'
    ];
    public function loras()
    {
        return $this->belongsToMany(Lora::class, 'style_lora');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function checkpoint()
    {
        return $this->belongsTo(Checkpoint::class);
    }
    public function embedding()
    {
        return $this->belongsTo(Embedding::class);
    }
}

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
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelRequest extends Model
{
    use HasFactory;

    protected $table = 'model_requests';

    protected $primaryKey = 'id';

    protected $fillable = [
        'modelName',
        'modelDescription',
        'sender_id',
        'approved_by',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}

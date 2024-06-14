<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourceRequest extends Model
{
    use HasFactory;

    protected $table = 'resource_requests';

    protected $primaryKey = 'id';

    protected $fillable = [
        "request_type",
        "resource_name",
        "resource_url",
        "resource_description",
        "sender_id",
        "approved_by",
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * 
 * This class represents a role model.
 */
class Role extends Model {
    use HasFactory;
    protected $fillable = ['name'];
}

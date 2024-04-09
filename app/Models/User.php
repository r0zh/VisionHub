<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 * 
 * This class represents a user model.
 */
class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    /**
     * Get the images for the user.
     */
    public function images() {
        return $this->hasMany(Image::class)->first();
    }

    /**
     * Check if the user has a specific role.
     *
     * @param string $roleName The role name.
     * @return bool
     */
    public function hasRole($roleName) {
        if ($this->role->name === $roleName) {
            return true;
        }
        return false;
    }

    /**
     * Get the role for the user.
     */
    public function role() {
        return $this->belongsTo(Role::class);
    }
}

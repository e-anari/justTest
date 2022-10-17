<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'firstname',
        'lastname',
        'country',
        'job',
        'email',
        'password',
        'password_confirm',
        'google_id',
        'google_token',
        'google_refresh_token',
        'two_factor_type',
        'phone',
        'is_admin',
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
    ];

    public function activeCodes(Type $var = null)
    {
        return $this->hasMany(ActiveCode::class);
    }

    // What is user rank? normal , staff or super?
    public function isAdmin()
    {
        return $this->is_admin;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions()
    {
        return $this->belongsToMAny(Permission::class);
    }

    public function hasPermission($permission)
    {
        return $this->permissins->contains('name', $permission->name) || $this->hasRole($permission->roles);
    }

    public function hasRole($roles)
    {
        return !!$this->roles->intersect($roles)->all();
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}

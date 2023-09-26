<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 *
 * @property integer id
 * @property string email
 * @property string first_name
 * @property string last_name
 * @property string password
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 * @package App\Models
 */
class User extends Authenticatable implements FilamentUser, HasName
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that are visible.
     *
     * @var array<int, string>
     */
    protected $visible = [
        'id',
        'first_name',
        'last_name',
        'email',
        'password',
        'created_at',
        'updated_at',
        'deleted_at',
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

    protected $appends = [
        'display_name',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime:Y-m-d\TH:i:sP',
        'created_at' => 'datetime:Y-m-d\TH:i:sP',
        'updated_at' => 'datetime:Y-m-d\TH:i:sP',
        'deleted_at' => 'datetime:Y-m-d\TH:i:sP',
        'password' => 'hashed',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return UserFactory
     */
    protected static function newFactory()
    {
        return new UserFactory();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stores() : HasMany
    {
        return $this->hasMany(Store::class);
    }

    public function getDisplayNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getFilamentName(): string
    {
        return $this->display_name ?? '';
    }

    /**
     * @param Panel $panel
     *
     * @return bool
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'phone', 'gender', 'image', 'breakfast', 'lunch', 'team_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Check the user is super admin.
     *
     * @return bool
     */
    public function isSuperAdmin()
    {
        return $this->hasRole(SUPER_ADMIN_ROLE);
    }

    /**
     * User belongs to a Team
     *
     * @return BelongsTo
     */
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }

    /**
     * Get the user's photo.
     *
     * @param  string  $value
     * @return string
     */
    public function getPhotoAttribute($value)
    {
        if ($this->image) {
            return $value;
        } else {
            if ($this->gender == GENDER_MALE) {
                return asset('assets/custom/user-default-image/male.webp');
            } else {
                return asset('assets/custom/user-default-image/female.webp');
            }
        }
    }

    /**
     * Get all users with create new user permission
     *
     * @return
     */
    public static function getUsersWithCreateNewUserPermissions()
    {
        return self::with('team')->role(SUPER_ADMIN_ROLE)->get();
    }
}

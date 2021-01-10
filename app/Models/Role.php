<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends \Spatie\Permission\Models\Role
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'guard_name'];

    /**
     * Check the role is super admin role.
     *
     * @return bool
     */
    public function isSuperAdmin()
    {
        return ($this->name == SUPER_ADMIN_ROLE);
    }

    /**
     * Exclude super admin role.
     *
     * @return bool
     */
    public function scopeExcludeSuperAdmin()
    {
        return $this->where('name', '!=', SUPER_ADMIN_ROLE);
    }

    /**
     * Get Super Admin role.
     *
     * @return bool
     */
    public function getSuperAdmin()
    {
        return self::where('name', SUPER_ADMIN_ROLE)->first();
    }
}

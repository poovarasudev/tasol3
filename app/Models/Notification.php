<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'short_description', 'description', 'user_ids'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['user_ids' => 'array'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['icon', 'human_readable_time'];

    /**
     * Get Icons name, used to show in modal.
     *
     * @param  string  $value
     * @return string
     */
    public function getIconAttribute()
    {
        $icons = ($this->type == NOTIFICATION_TYPE_GENERAL) ? ['fe-rss', 'fe-radio', 'fe-activity'] :
            ['fe-info', 'fe-alert-circle', 'fe-share-2'];
        return $icons[random_int(0,  2)];
    }

    /**
     * Get human_readable_time, to show values like '1 mins ago'
     *
     * @param  string  $value
     * @return string
     */
    public function getHumanReadableTimeAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}

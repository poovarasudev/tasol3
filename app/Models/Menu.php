<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'for', 'order_type', 'bill_type', 'price'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['price' => 'double'];
}

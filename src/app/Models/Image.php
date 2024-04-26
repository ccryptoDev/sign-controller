<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'no', 'type', 'name', 'path', 'keywords', 'cloudsync', 'cloudsync_data', 'controller_no', 'message1', 'message2', 'message3', 'message', 'three_line_alignment'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'cloudsync' => 'boolean', 
        'message1' => 'array', 
        'message2' => 'array', 
        'message3' => 'array', 
        'message' => 'array', 
        'three_line_alignment' => 'array',
        'cloudsync_data' => 'datetime' 
    ];
}

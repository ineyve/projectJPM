<?php

namespace App;

use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;

class PrintRequest extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'requestNumber', 'description', 'request_date', 'due_date', 'quantity', 'colored', 'stapled', 'paper_size', 'paper_type', 'file'
    ];


}

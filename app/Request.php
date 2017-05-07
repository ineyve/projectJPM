<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Request extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'requestNumber', 'description', 'open_date', 'due_date', 'quantity', 'colored', 'stapled', 'paper_size', 'paper_type', 'file'
    ];


}

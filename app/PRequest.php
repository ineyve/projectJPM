<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class PRequest extends Model
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

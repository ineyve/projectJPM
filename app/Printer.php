<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Printer extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function dateCreated()
    {
        $date = new Carbon($this->created_at);
        return $date->toDateString();
    }

    public function dateupdated()
    {
        $date = new Carbon($this->updated_at);
        return $date->toDateString();
    }
}

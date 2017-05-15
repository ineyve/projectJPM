<?php

namespace App;

use Carbon\Carbon;
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
        'id', 'owner_id', 'description', 'open_date', 'due_date', 'quantity', 'colored', 'stapled', 'paper_size', 'paper_type', 'file', 'status'
    ];

    public function statusToStr(){
        if($this->status)
            return 'Rejected';
        if($this->closed_date != '')
            return 'Complete';
        else
            return 'In Progress';
    }

    public function coloredToStr(){
        if($this->colored == 1){
            return 'Color';
        }
        else{
            return 'Black and White';
        }
    }

    public function stapledToStr(){
        if($this->stapled == 0)
            return 'With Staple';
        else
            return 'No Staple';
    }

    public function typeToStr(){
        switch($this->paper_type){
            case 0: return 'Draft';
                break;
            case 1: return 'Normal';
                break;
            case 2: return 'Photographic';
                break;
        }
    }

    public function date(){
        $date = new Carbon($this->open_date);
        return $date->toDateString();
    }

    public function user(){
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

}

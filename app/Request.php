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
        switch($this->status){
            case -1: return 'Rejected';
                break;
            case 0: return 'Pending';
                break;
            case 1: return 'Accepted';
                break;
            case 2: return 'In Progress';
                break;
            case 3: return 'Ready';
                break;

        }
        return 'Complete';
    }

    public function coloredToStr(){
       // if($this->colored)
        //    return 'True';
       // else
        //    return 'False';

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

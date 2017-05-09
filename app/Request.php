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

    public function dateOnlyDay(){
        $date = Carbon::create($this->date);
        return $date->toDateString();
    }

    public function user(){
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

}

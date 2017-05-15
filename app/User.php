<?php

namespace App;

use Carbon\Carbon;
use DateTime;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'department_id', 'password', 'admin', 'blocked', 'print_evals', 'print_counts'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public function department(){
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function verified()
    {
        $this->activated = 1;
        $this->save();
    }

    public function memberFor(){
        $diffYears=$this->created_at->diffInYears(Carbon::now());
        $diffMonths=$this->created_at->diffInMonths(Carbon::now());
        $diffDays=$this->created_at->diffInDays(Carbon::now());
        $diff=$this->created_at->diff(Carbon::now());

        if($diffYears == 0)
            if($diffMonths == 0)
                return $diff->format('%d days');
            else
                if($diffDays == 0)
                    return $diff->format('%m months');
                else
                    return $diff->format('%m months  and %d days');
        else
            if($diffMonths == 0)
                if($diffDays == 0)
                    return $diff->format('%y years');
                else
                    return $diff->format('%y years and %d days');
            else
                if($diffDays == 0)
                    return $diff->format('%y years and %m months');
                else
                    return $diff->format('%y years, %m months and %d days');
    }

    public function requests()
    {
        return $this->hasMany('App\Request', 'owner_id', 'id');
    }

    public function averageRating(){
        $average = $this->requests()->where('satisfaction_grade', '!=', '')->sum('satisfaction_grade');
        $count = $this->requests()->where('satisfaction_grade', '!=', '')->count();
        if($count == 0)
            return 0;
        else
            return round($average/$count);
    }

    public function adminToStr(){
        if($this->admin)
            return 'Yes';
        else
            return 'No';
    }

    public function blockedToStr(){
        if($this->blocked)
            return 'Yes';
        else
            return 'No';
    }
}

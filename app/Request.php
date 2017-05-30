<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class Request extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'owner_id', 'description', 'created_at', 'due_date', 'quantity', 'colored', 'stapled', 'paper_size', 'paper_type', 'file', 'status'
    ];

    public function statusToStr()
    {
        switch ($this->status) {
            case 0: return 'Pending';
                break;
            case 1: return 'Rejected';
                break;
            case 2: return 'Complete';
                break;
        }
    }

    public function coloredToStr()
    {
        if ($this->colored == 1) {
            return 'Color';
        } else {
            return 'Black and White';
        }
    }

    public function stapledToStr()
    {
        if ($this->stapled) {
            return 'With Staple';
        } else {
            return 'No Staple';
        }
    }

    public function typeToStr()
    {
        switch ($this->paper_type) {
            case 0: return 'Draft';
                break;
            case 1: return 'Normal';
                break;
            case 2: return 'Photographic';
                break;
        }
    }

    public function frontBackToStr()
    {
        if ($this->front_back == 0) {
            return 'Single Page';
        } else {
            return 'Front and Back';
        }
    }

    public function date()
    {
        $date = new Carbon($this->due_date);
        return $date->toDateString();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function hasImage()
    {
        if (isset($this->file)) {
            $extension = explode('.', $this->file)[1];
            if ($extension == "png") {
                return true;
            }
        }
        return false;
    }

    public function image()
    {
        return base64_encode(file_get_contents('../storage/app/print-jobs/'.$this->owner_id.'/'.$this->file));
    }
}

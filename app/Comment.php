<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;



class Comment extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comment'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public function findComment(Request $request){
        
        
       // $comments = Comment::All('comment');
        $comments = Comment::where('request_id', '=', $request->id)->get();

        foreach ($comments as $comment) {
            
            if ($this->request_id == $request->id) {
                $comments = $comment;           
            }  
        }
        return $comments;
           
    }


}
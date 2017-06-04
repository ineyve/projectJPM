<?php

namespace App\Policies;

use App\User;
use App\Request;
use Illuminate\Auth\Access\HandlesAuthorization;

class RequestPolicy
{
    use HandlesAuthorization;

    public function selfOrAdmin(User $user, Request $request)
    {
        return ($user->admin||$user->id==$request->owner_id);
    }

    public function self(User $user, Request $request)
    {
        return ($user->id==$request->owner_id);
    }
}

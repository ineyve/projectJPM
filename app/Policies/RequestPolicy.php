<?php

namespace App\Policies;

use App\User;
use App\Request;
use Illuminate\Auth\Access\HandlesAuthorization;

class RequestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the request.
     *
     * @param  \App\User    $user
     * @param  \App\Request $request
     * @return mixed
     */
    public function selfOrAdmin(User $user, Request $request)
    {
        return ($user->admin||$user->id==$request->owner_id);
    }

    public function self(User $user, Request $request)
    {
        return ($user->id==$request->owner_id);
    }

    /**
     * Determine whether the user can create requests.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        return true;
    }

    /**
     * Determine whether the user can update the request.
     *
     * @param  \App\User    $user
     * @param  \App\Request $request
     * @return mixed
     */
    public function update(User $user, Request $request)
    {
        //
    }

    /**
     * Determine whether the user can delete the request.
     *
     * @param  \App\User    $user
     * @param  \App\Request $request
     * @return mixed
     */
    public function delete(User $user, Request $request)
    {
        //
    }
}

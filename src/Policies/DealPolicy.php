<?php

namespace Innoboxrr\Deals\Policies;

use App\Models\User;
use Innoboxrr\Deals\Models\Deal;
use Illuminate\Auth\Access\HandlesAuthorization;

class DealPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {

        $exceptAbilities = [];

        if($user->isAdmin() && !in_array($ability, $exceptAbilities)){
        
            return true;
            
        }

    }

    public function index(User $user)
    {
        return false;
    }

    public function viewAny(User $user)
    {
        return false;
    }

    public function view(User $user, Deal $deal)
    {
        return false;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, Deal $deal)
    {
        return false;
    }

    public function delete(User $user, Deal $deal)
    {
        return false;
    }

    public function restore(User $user, Deal $deal)
    {
        return false;
    }

    public function forceDelete(User $user, Deal $deal)
    {
        return false;
    }

    public function export(User $user)
    {
        return false;
    }

}

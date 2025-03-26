<?php

namespace Innoboxrr\Deals\Policies;

use App\Models\User;
use Innoboxrr\Deals\Models\DealAd;
use Illuminate\Auth\Access\HandlesAuthorization;

class DealAdPolicy
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

    public function view(User $user, DealAd $dealAd)
    {
        return false;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, DealAd $dealAd)
    {
        return false;
    }

    public function delete(User $user, DealAd $dealAd)
    {
        return false;
    }

    public function restore(User $user, DealAd $dealAd)
    {
        return false;
    }

    public function forceDelete(User $user, DealAd $dealAd)
    {
        return false;
    }

    public function export(User $user)
    {
        return false;
    }

}

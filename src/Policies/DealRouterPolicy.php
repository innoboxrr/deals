<?php

namespace Innoboxrr\Deals\Policies;

use App\Models\User;
use Innoboxrr\Deals\Models\DealRouter;
use Illuminate\Auth\Access\HandlesAuthorization;

class DealRouterPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {

        $exceptAbilities = [];

        if($user->isDealManager() && !in_array($ability, $exceptAbilities)){
        
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

    public function view(User $user, DealRouter $dealRouter)
    {
        return false;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, DealRouter $dealRouter)
    {
        return false;
    }

    public function delete(User $user, DealRouter $dealRouter)
    {
        return false;
    }

    public function restore(User $user, DealRouter $dealRouter)
    {
        return false;
    }

    public function forceDelete(User $user, DealRouter $dealRouter)
    {
        return false;
    }

    public function export(User $user)
    {
        return false;
    }

}

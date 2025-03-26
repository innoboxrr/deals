<?php

namespace Innoboxrr\Deals\Policies;

use App\Models\User;
use Innoboxrr\Deals\Models\DealRouterExecution;
use Illuminate\Auth\Access\HandlesAuthorization;

class DealRouterExecutionPolicy
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

    public function view(User $user, DealRouterExecution $dealRouterExecution)
    {
        return false;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, DealRouterExecution $dealRouterExecution)
    {
        return false;
    }

    public function delete(User $user, DealRouterExecution $dealRouterExecution)
    {
        return false;
    }

    public function restore(User $user, DealRouterExecution $dealRouterExecution)
    {
        return false;
    }

    public function forceDelete(User $user, DealRouterExecution $dealRouterExecution)
    {
        return false;
    }

    public function export(User $user)
    {
        return false;
    }

}

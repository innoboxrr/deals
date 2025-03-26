<?php

namespace Innoboxrr\Deals\Policies;

use App\Models\User;
use Innoboxrr\Deals\Models\DealAdvertiser;
use Illuminate\Auth\Access\HandlesAuthorization;

class DealAdvertiserPolicy
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

    public function view(User $user, DealAdvertiser $dealAdvertiser)
    {
        return false;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, DealAdvertiser $dealAdvertiser)
    {
        return false;
    }

    public function delete(User $user, DealAdvertiser $dealAdvertiser)
    {
        return false;
    }

    public function restore(User $user, DealAdvertiser $dealAdvertiser)
    {
        return false;
    }

    public function forceDelete(User $user, DealAdvertiser $dealAdvertiser)
    {
        return false;
    }

    public function export(User $user)
    {
        return false;
    }

}

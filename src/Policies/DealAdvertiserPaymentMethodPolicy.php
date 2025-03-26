<?php

namespace Innoboxrr\Deals\Policies;

use App\Models\User;
use Innoboxrr\Deals\Models\DealAdvertiserPaymentMethod;
use Illuminate\Auth\Access\HandlesAuthorization;

class DealAdvertiserPaymentMethodPolicy
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

    public function view(User $user, DealAdvertiserPaymentMethod $dealAdvertiserPaymentMethod)
    {
        return false;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, DealAdvertiserPaymentMethod $dealAdvertiserPaymentMethod)
    {
        return false;
    }

    public function delete(User $user, DealAdvertiserPaymentMethod $dealAdvertiserPaymentMethod)
    {
        return false;
    }

    public function restore(User $user, DealAdvertiserPaymentMethod $dealAdvertiserPaymentMethod)
    {
        return false;
    }

    public function forceDelete(User $user, DealAdvertiserPaymentMethod $dealAdvertiserPaymentMethod)
    {
        return false;
    }

    public function export(User $user)
    {
        return false;
    }

}

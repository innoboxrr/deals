<?php

namespace Innoboxrr\Deals\Policies;

use App\Models\User;
use Innoboxrr\Deals\Models\DealAdvertiserAgreementDaily;
use Illuminate\Auth\Access\HandlesAuthorization;

class DealAdvertiserAgreementDailyPolicy
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

    public function view(User $user, DealAdvertiserAgreementDaily $dealAdvertiserAgreementDaily)
    {
        return false;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, DealAdvertiserAgreementDaily $dealAdvertiserAgreementDaily)
    {
        return false;
    }

    public function delete(User $user, DealAdvertiserAgreementDaily $dealAdvertiserAgreementDaily)
    {
        return false;
    }

    public function restore(User $user, DealAdvertiserAgreementDaily $dealAdvertiserAgreementDaily)
    {
        return false;
    }

    public function forceDelete(User $user, DealAdvertiserAgreementDaily $dealAdvertiserAgreementDaily)
    {
        return false;
    }

    public function export(User $user)
    {
        return false;
    }

}

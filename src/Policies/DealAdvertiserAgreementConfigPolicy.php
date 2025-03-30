<?php

namespace Innoboxrr\Deals\Policies;

use App\Models\User;
use Innoboxrr\Deals\Models\DealAdvertiserAgreementConfig;
use Illuminate\Auth\Access\HandlesAuthorization;

class DealAdvertiserAgreementConfigPolicy
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

    public function view(User $user, DealAdvertiserAgreementConfig $dealAdvertiserAgreementConfig)
    {
        return false;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, DealAdvertiserAgreementConfig $dealAdvertiserAgreementConfig)
    {
        return false;
    }

    public function delete(User $user, DealAdvertiserAgreementConfig $dealAdvertiserAgreementConfig)
    {
        return false;
    }

    public function restore(User $user, DealAdvertiserAgreementConfig $dealAdvertiserAgreementConfig)
    {
        return false;
    }

    public function forceDelete(User $user, DealAdvertiserAgreementConfig $dealAdvertiserAgreementConfig)
    {
        return false;
    }

    public function export(User $user)
    {
        return false;
    }

}

<?php

namespace Innoboxrr\Deals\Policies;

use App\Models\User;
use Innoboxrr\Deals\Models\DealAdvertiserAgreementCplAdjustment;
use Illuminate\Auth\Access\HandlesAuthorization;

class DealAdvertiserAgreementCplAdjustmentPolicy
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

    public function view(User $user, DealAdvertiserAgreementCplAdjustment $dealAdvertiserAgreementCplAdjustment)
    {
        return false;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, DealAdvertiserAgreementCplAdjustment $dealAdvertiserAgreementCplAdjustment)
    {
        return false;
    }

    public function delete(User $user, DealAdvertiserAgreementCplAdjustment $dealAdvertiserAgreementCplAdjustment)
    {
        return false;
    }

    public function restore(User $user, DealAdvertiserAgreementCplAdjustment $dealAdvertiserAgreementCplAdjustment)
    {
        return false;
    }

    public function forceDelete(User $user, DealAdvertiserAgreementCplAdjustment $dealAdvertiserAgreementCplAdjustment)
    {
        return false;
    }

    public function export(User $user)
    {
        return false;
    }

}

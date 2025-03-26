<?php

namespace Innoboxrr\Deals\Policies;

use App\Models\User;
use Innoboxrr\Deals\Models\DealAdvertiserAgreementPostback;
use Illuminate\Auth\Access\HandlesAuthorization;

class DealAdvertiserAgreementPostbackPolicy
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

    public function view(User $user, DealAdvertiserAgreementPostback $dealAdvertiserAgreementPostback)
    {
        return false;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, DealAdvertiserAgreementPostback $dealAdvertiserAgreementPostback)
    {
        return false;
    }

    public function delete(User $user, DealAdvertiserAgreementPostback $dealAdvertiserAgreementPostback)
    {
        return false;
    }

    public function restore(User $user, DealAdvertiserAgreementPostback $dealAdvertiserAgreementPostback)
    {
        return false;
    }

    public function forceDelete(User $user, DealAdvertiserAgreementPostback $dealAdvertiserAgreementPostback)
    {
        return false;
    }

    public function export(User $user)
    {
        return false;
    }

}

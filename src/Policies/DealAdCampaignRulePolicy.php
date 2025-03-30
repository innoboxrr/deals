<?php

namespace Innoboxrr\Deals\Policies;

use App\Models\User;
use Innoboxrr\Deals\Models\DealAdCampaignRule;
use Illuminate\Auth\Access\HandlesAuthorization;

class DealAdCampaignRulePolicy
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

    public function view(User $user, DealAdCampaignRule $dealAdCampaignRule)
    {
        return false;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, DealAdCampaignRule $dealAdCampaignRule)
    {
        return false;
    }

    public function delete(User $user, DealAdCampaignRule $dealAdCampaignRule)
    {
        return false;
    }

    public function restore(User $user, DealAdCampaignRule $dealAdCampaignRule)
    {
        return false;
    }

    public function forceDelete(User $user, DealAdCampaignRule $dealAdCampaignRule)
    {
        return false;
    }

    public function export(User $user)
    {
        return false;
    }

}

<?php

namespace Innoboxrr\Deals\Models\Traits\Mutators;

trait DealAdvertiserAgreementMutators
{

	public function getCallsAttribute()
    {
        $calls = $this->getPayload('integration.calls');

        if (is_string($calls)) {
            $calls = json_decode($calls, true);
        }
        if (is_array($calls)) {
            return $calls;
        }
        return [];
    }

}
<?php

namespace Innoboxrr\Deals\Models\Traits\Operations;

trait DealAdPlatformOperations
{

    public function buildPayload()
    {
        return [
            'type' => $this->meta('type'), // google, facebook, etc.
            'credentials' => (array) $this->meta('credentials', []),
            'settings' => (array) $this->meta('settings', []),
        ];
    }

    public function updatePayload()
    {
        $this->payload = $this->buildPayload();
        return $this->save();
    }
}

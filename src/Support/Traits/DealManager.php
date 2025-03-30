<?php

namespace Innoboxrr\Deals\Support\Traits;

trait DealManager
{
    public function isDealManager()
    {
        if(method_exists($this, 'dealManagerRole')) {
            return $this->dealManagerRole() == true;
        }
        return false;
    }
}
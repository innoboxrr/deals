<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads;

class AgreementSelectorService
{
    public static function select($agreements, $dealLead)
    {
        // Aquí puede ir un algoritmo más complejo
        return $agreements->random();
    }
}

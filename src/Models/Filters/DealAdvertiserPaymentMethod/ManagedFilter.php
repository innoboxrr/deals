<?php

namespace Innoboxrr\Deals\Models\Filters\DealAdvertiserPaymentMethod;

use Innoboxrr\SearchSurge\Search\Utils\Managed;

class ManagedFilter extends Managed
{

    public static function canView($query, $user, array $args = [])
    {   

        // Añadir restricciones de visibilidad

        return $query;

    }

}
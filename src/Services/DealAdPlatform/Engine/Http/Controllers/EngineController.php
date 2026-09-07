<?php

declare(strict_types=1);

namespace Innoboxrr\Deals\Services\DealAdPlatform\Engine\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Controller base para el Engine del paquete.
 * Extiende el Controller de Laravel y añade helpers comunes.
 */
abstract class EngineController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, DispatchesJobs;
}

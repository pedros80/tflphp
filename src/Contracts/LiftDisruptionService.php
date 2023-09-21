<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Contracts;

interface LiftDisruptionService
{
    /**
     * List of all currently disrupted lift routes
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Disruptions-Lifts&operation=get
     * @link https://api-portal.tfl.gov.uk/api-details#api=Disruptions-Lifts-v2&operation=get
     */
    public function getDisruptions(bool $v2=true): array;
}

<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Contracts;

interface AccidentStatsService
{
    /**
     * Gets all accident details for accidents occuring in the specified year
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=AccidentStats&operation=AccidentStats_Get
     */
    public function getDetails(int $year): array;
}

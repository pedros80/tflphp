<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Enums;

enum Directions: string
{
    case ALL      = 'all';
    case INBOUND  = 'inbound';
    case OUTBOUND = 'outbound';
}

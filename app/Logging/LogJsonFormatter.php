<?php

namespace App\Logging;

use Monolog\Formatter\JsonFormatter;

class LogJsonFormatter
{
    public function __invoke($logger)
    {
        $monolog = $logger->getLogger();
        foreach ($monolog->getHandlers() as $handler) {
            $handler->setFormatter(new JsonFormatter(
                JsonFormatter::BATCH_MODE_NEWLINES,
                true
            ));
        }
    }
}

<?php

namespace App\Component\Logger;

use App\Component\Logger\LoggerInterface;
use App\ConfigProvider;

/**
 * Формат логов: [YYYY-MM-DD H:m:i] LEVEL: MESSAGE [CLASS::METHOD]
 */
class DefaultLogger implements LoggerInterface
{
    /**
     * @param string $message
     * @param array  $context
     */
    public function emergency($message, array $context = [])
    {
        // TODO: Implement emergency() method.
    }

    /**
     * @param string $message
     * @param array  $context
     */
    public function alert($message, array $context = [])
    {
        // TODO: Implement alert() method.
    }

    /**
     * @param string $message
     * @param array  $context
     */
    public function critical($message, array $context = [])
    {
        // TODO: Implement critical() method.
    }

    /**
     * @param string $message
     * @param array  $context
     */
    public function error($message, array $context = [])
    {
        // TODO: Implement error() method.
    }

    public function warning($message, array $context = [])
    {
        // TODO: Implement warning() method.
    }

    /**
     * @param string $message
     * @param array  $context
     */
    public function notice($message, array $context = [])
    {
        // TODO: Implement notice() method.
    }

    /**
     * @param string $message
     * @param array  $context
     */
    public function info($message, array $context = [])
    {
        // TODO: Implement info() method.
    }

    /**
     * @param string $message
     * @param array  $context
     */
    public function debug($message, array $context = [])
    {
        // TODO: Implement debug() method.
    }

    /**
     * @param mixed  $level
     * @param string $message
     * @param array  $context
     */
    public function log($level, $message, array $context = []): void
    {
        $logString = sprintf(
            '[%s] %s: %s [%s::%s]',
            (new DateTime())->format('YYYY-MM-DD H:m:i'),
            $level,
            $message,
            $context['class'],
            $context['method']
        );

        file_put_contents(ConfigProvider::getDefaultFilePath(), $logString, FILE_APPEND);
    }
}
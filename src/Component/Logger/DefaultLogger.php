<?php

namespace App\Component\Logger;

use App\Core\Interfaces\Psr\LoggerInterface;
use App\ConfigProvider;
use DateTime;
use JetBrains\PhpStorm\Pure;

/**
 * Формат логов: [YYYY-MM-DD H:m:i] LEVEL: MESSAGE [CLASS::METHOD]
 */
class DefaultLogger implements LoggerInterface
{
    public const DEFAULT_PATH = 'main';

    /**
     * @var \App\Component\Logger\DefaultLogger|null
     */
    private static ?DefaultLogger $logger = null;

    private function __construct()
    {
    }

    /**
     * @return \App\Component\Logger\DefaultLogger
     */
    public static function getInstance(): DefaultLogger
    {
        if (self::$logger === null) {
            self::$logger = new self();
        }

        return self::$logger;
    }

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
     * @param string $channel
     */
    public function log($level, $message, array $context = [], string $channel = 'main'): void
    {
        $logString = sprintf(
            "[%s] %s: %s [%s on line %s] \n",
            (new DateTime())->format('Y-m-d H:i:s'),
            $level,
            $message,
            $context['file'],
            $context['line'],
        );

        file_put_contents(
            $this->getPath($channel),
            $logString,
            FILE_APPEND
        );
    }

    /**
     * @param string $channel
     *
     * @return string
     */
    #[Pure] private function getPath(string $channel): string
    {
        return ConfigProvider::getDefaultFilePath() . ($channel ?? self::DEFAULT_PATH) . '.log';
    }
}

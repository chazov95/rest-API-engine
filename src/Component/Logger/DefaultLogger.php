<?php

namespace App\Component\Logger;

use App\Component\Logger\LoggerInterface;
use App\ConfigProvider;
use DateTime;

/**
 * Формат логов: [YYYY-MM-DD H:m:i] LEVEL: MESSAGE [CLASS::METHOD]
 */
class DefaultLogger implements LoggerInterface
{
    public const DEFAULT_PATH = 'main';
    private string $path;

    private function __construct(string $path)
    {
        $this->setPath($path);
    }

    /**
     * @param string $string
     *
     * @return \App\Component\Logger\DefaultLogger
     */
    public static function get(string $string): DefaultLogger
    {
        return new self($string);
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
     */
    public function log($level, $message, array $context = []): void
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
            $this->path,
            $logString,
            FILE_APPEND
        );
    }

    /**
     * @param string $path
     *
     * @return void
     */
    public function setPath(string $path): void
    {
        $this->path = ConfigProvider::getDefaultFilePath() . ($path ?? self::DEFAULT_PATH) . '.log';
    }
}
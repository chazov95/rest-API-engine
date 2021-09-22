<?php

namespace App\Component\Logger;

class LogLevels
{
    /**
     * Подробная информация для отладки
     *
     * @var string
     */
    public const DEBUG     = 'DEBUG';

    /**
     * Исключительные случаи, но не ошибки
     *
     * @var string
     */
    public const WARNING   = 'WARNING';

    /**
     * Интересные события
     *
     * @var string
     */
    public const INFO      = 'INFO';

    /**
     * Существенные события, но не ошибки
     *
     * @var string
     */
    public const NOTICE    = 'NOTICE';

    /**
     * Ошибки исполнения, не требующие сиюминутного вмешательства
     *
     * @var string
     */
    public const ERROR     = 'ERROR';

    /**
     * Критические состояния (компонент системы недоступен, неожиданное исключение)
     *
     * @var string
     */
    public const CRITICAL  = 'CRITICAL';

    /**
     * Действие требует безотлагательного вмешательства
     *
     * @var string
     */
    public const ALERT     = 'ALERT';

    /**
     *  Система не работает
     *
     * @var string
     */
    public const EMERGENCY = 'EMERGENCY';
}

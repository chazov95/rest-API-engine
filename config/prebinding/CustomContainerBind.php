<?php
$customBind = [
    'default_logger' => function () {
        return \App\Component\Logger\DefaultLogger::getInstance();
    }
];
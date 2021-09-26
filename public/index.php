<?php

use App\Core\CoreLoader;

include __DIR__ . '/../autoload.php';

$loader = new CoreLoader();
$loader->load();
/*
echo \App\ConfigProvider::getDefaultFilePath(); //TODO убрать. Написано для теста*/
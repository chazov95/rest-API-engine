<?php

use App\Core\Transformations\Deserializer\Deserializer;

$simpleContainerPrebind = [
    Deserializer::class => static function () {
        return new Deserializer();
    },
];
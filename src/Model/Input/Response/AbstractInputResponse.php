<?php

namespace App\Model\Input\Response;

abstract class AbstractInputResponse
{
    public bool $success = true;
    public int $code = 200;
}
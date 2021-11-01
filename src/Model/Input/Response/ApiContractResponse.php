<?php

namespace App\Model\Input\Response;

use App\Model\Db\ApiContractModel;

class ApiContractResponse extends AbstractInputResponse
{
    public ApiContractModel $data;
}
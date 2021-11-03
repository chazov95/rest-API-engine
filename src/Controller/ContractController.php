<?php

namespace App\Controller;

use App\Core\Abstractions\AbstractController;
use App\Model\Input\Request\ContractMethodDto;
use App\Model\Input\Response\ApiContractResponse;
use App\Model\Input\Response\SuccessResponse;

class ContractController extends AbstractController
{
    public function viewContract(): ApiContractResponse
    {
        // TODO impement this method
        return new ApiContractResponse();
    }

    public function addMethodToContract(ContractMethodDto $contractMethodDto): SuccessResponse
    {
        // TODO impement this method
        return new SuccessResponse();
    }
}
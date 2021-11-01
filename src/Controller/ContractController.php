<?php

namespace App\Controller;

use App\Core\Abstractions\AbstractController;
use App\Core\Interfaces\SerializerInterface;
use App\Model\Input\Request\ContractMethodDto;
use App\Model\Input\Response\ApiContractResponse;

class ContractController extends AbstractController
{
    public function viewContract(SerializerInterface $serializer): ApiContractResponse
    {
        $response = new ApiContractResponse();

        return $serializer->convertToJson($response);
    }

    public function addMethodToContract(ContractMethodDto $contractMethodDto)
    {
        // TODO impement this method
        return 'its work!';
    }
}
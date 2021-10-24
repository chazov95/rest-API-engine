<?php

namespace App\Controller;

use App\Core\Abstractions\AbstractController;
use App\Model\Input\Request\ContractMethodDto;

class ContractController extends AbstractController
{
    public function viewContract()
    {
        return 'its work!';
    }

    public function addMethodToContract(ContractMethodDto $contractMethodDto)
    {
        // TODO impement this method
        return 'its work!';
    }
}
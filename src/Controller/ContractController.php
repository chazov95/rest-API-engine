<?php

namespace App\Controller;

use App\Core\Abstractions\AbstractController;
use App\Core\Orm\QueryBuilder;
use App\Model\Input\Request\ContractMethodDto;
use App\Model\Input\Response\ApiContractResponse;
use App\Model\Input\Response\SuccessResponse;

class ContractController extends AbstractController
{
    public function viewContract(): ApiContractResponse
    {
        $qb = new QueryBuilder();
        $qb->setTable('testTable')
            ->setMethod(QueryBuilder::DELETE_METHOD)
            ->setJoin('leftJoin', 'tableName', ['a', '=', 'b'])
            ->setOrderBy('id', 'ASC')
            ->setWhere('id', '=', 123)
            ->setSelect(['id', 'name'])
            ->setWhereIsNull('a1')
            ->setWhereIn('a3', [17, 19])
            ->setLimit(10)
            ->build()
            ->getResult()
            ->execute();

        // TODO impement this method
        return new ApiContractResponse();
    }

    public function addMethodToContract(ContractMethodDto $contractMethodDto): SuccessResponse
    {
        // TODO impement this method
        return new SuccessResponse();
    }
}
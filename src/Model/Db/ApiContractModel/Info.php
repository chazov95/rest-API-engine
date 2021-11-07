<?php

namespace App\Model\Db\ApiContractModel;

use App\Model\Db\ApiContractModel\Info\Contact;
use App\Model\Db\ApiContractModel\Info\License;

class Info
{
    public string  $description    = '';
    public string  $version        = '';
    public string  $title          = '';
    public string  $termsOfService = '';
    public Contact $contact;
    public License $license;
}
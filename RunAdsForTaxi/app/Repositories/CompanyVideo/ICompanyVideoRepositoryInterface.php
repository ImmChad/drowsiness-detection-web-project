<?php

namespace App\Repositories\CompanyVideo;

interface ICompanyVideoRepositoryInterface
{
    function getCompanyVideoSWithCompanyID(int $companyID);
}

<?php

namespace App\Repositories\CompanyPhoto;

interface ICompanyPhotoRepositoryInterface
{
    function getLatestCompanyPhotoSWithCompanyID(int $companyID);
}

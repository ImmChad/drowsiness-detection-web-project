<?php

namespace App\Http\Controllers\Backend\Company;

use App\Handlers\CompanyHandler;
use App\Http\Controllers\Controller;
use App\Repositories\CompanyVideo\CompanyPhotoRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Session;

class CompanyController extends Controller
{


    public function __construct(private readonly CompanyHandler $companyHandler)
    {

    }

    /**
     * @return Factory|View|Application
     */
    function showAddCompany(): Factory|View|Application
    {
        return $this->companyHandler->showAddCompany();
    }

    /**
     * @return Factory|View|Application
     */
    function showAllCompany(): Factory|View|Application
    {
        return $this->companyHandler->showAllCompany();
    }


    /**
     * @param Request $request
     * @return int
     */
    function addNewCompany(Request $request): int
    {
        return $this->companyHandler->addNewCompany($request);
    }


    /**
     * @param Request $request
     * @return mixed
     */
    function updateNewCompany(Request $request): mixed
    {
        return $this->companyHandler->updateNewCompany($request);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    function deleteCompany(Request $request): mixed
    {
        return $this->companyHandler->deleteCompany($request);
    }

}

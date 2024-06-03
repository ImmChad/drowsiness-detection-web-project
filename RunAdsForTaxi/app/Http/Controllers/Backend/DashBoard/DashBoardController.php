<?php

namespace App\Http\Controllers\Backend\DashBoard;
use App\Handlers\DashBoardHandler;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class DashBoardController extends Controller
{
    public function __construct(private readonly DashBoardHandler $dashBoardHandler)
    {
    }

    /**
     * @return Factory|View|Application
     */
    function index(): Factory|View|Application
    {
           return $this->dashBoardHandler->index();
    }

    /**
     * @param Request $request
     * @return array
     */
    function getDataStatistics(Request $request): array
    {
           return $this->dashBoardHandler->getDataStatistics($request);
    }

    static function getDataCompany_withCompanyID($company_id)
    {
        return DB::table('company')
            ->where(['company_id'=>$company_id,
                    ])
            ->get()->first();
    }

}

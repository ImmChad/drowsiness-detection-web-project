<?php

namespace App\Handlers;

use App\Repositories\CompanyPhoto\CompanyPhotoRepository;
use App\Repositories\CompanyVideo\CompanyVideoRepository;
use App\Repositories\Photo\PhotoRepository;
use App\Repositories\Vehicle\VehicleRepository;
use App\Repositories\VehicleCompany\VehicleCompanyRepository;
use App\Repositories\Video\VideoRepository;
use App\Repositories\ViewAdsVideo\ViewAdsVideoRepository;
use Illuminate\Http\Request;

class HumanEventHandler
{
    public function __construct(
        private readonly VehicleCompanyRepository $vehicleCompanyRepository,
        private readonly CompanyVideoRepository   $companyVideoRepository,
        private readonly CompanyPhotoRepository   $companyPhotoRepository,
        private readonly VideoRepository          $videoRepository,
        private readonly PhotoRepository          $photoRepository,
        private readonly VehicleRepository        $vehicleRepository,
        private readonly ViewAdsVideoRepository   $viewAdsVideoRepository
    )
    {
    }

    /**
     * @param Request $request
     *
     * @return array|null[]
     */
    function login(Request $request): array
    {

        $dataVehicle = $this->vehicleRepository->getDataVehicleWithAppID($request->app_id);

        if(!isset($dataVehicle))
        {
            return ["isLogin" => null];
        }

        return [
            'isLogin'=>$request->app_id,
        ];
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    function insertHumanEvent(Request $request): array
    {
        $dataVehicle = $this->vehicleRepository-> getDataVehicleWithAppID($request->app_id);
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $now = date("Y-m-d H:i:s");
        $result = $this->viewAdsVideoRepository->insertViewAdsVideo(
            $dataVehicle->id,
            $now
        );

        return [
            'is_success'=>$result
        ];
    }
}

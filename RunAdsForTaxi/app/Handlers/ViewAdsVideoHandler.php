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

class ViewAdsVideoHandler
{
    /**
     * @param VehicleCompanyRepository $vehicleCompanyRepository
     * @param CompanyVideoRepository $companyVideoRepository
     * @param CompanyPhotoRepository $companyPhotoRepository
     * @param VideoRepository $videoRepository
     * @param PhotoRepository $photoRepository
     * @param VehicleRepository $vehicleRepository
     * @param ViewAdsVideoRepository $viewAdsVideoRepository
     */
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
     * @return array|null[]
     */
    function getAllVideoWithAppID(Request $request): array
    {

        $dataVehicle = $this->vehicleRepository->getDataVehicleWithAppID($request->app_id);
        if(!isset($dataVehicle))
        {
            return ["isLogin"=>null];
        }
        $video_latest = self::getLatestVideoAdsWorkedWithCompanyID($dataVehicle->company_id);
        $photo_latest = self::getLatestPhotoAdsWorkedWithCompanyID($dataVehicle->company_id);
        $video = $this->videoRepository->find($video_latest->video_id);
        $photo = $this->photoRepository->find($photo_latest->photo_id);

        $photo->md5_encrypt = md5($photo->photo_path);
        if(md5($video->video_path) == $request->video_md5_encrypt)
        {
            $video = null;
        }
        else
        {
            $video->md5_encrypt = md5($video->video_path);
        }
        return [
            'video'=>$video,
            'photo'=>$photo,
            'change_time'=>$video_latest->change_time,
            'isLogin'=>$request->app_id,
        ];
    }

    /**
     * @param int $companyId
     * @return mixed
     */
    function getLatestVideoAdsWorkedWithCompanyID(int $companyId): mixed
    {
        $childGroup  = $this->vehicleCompanyRepository->getDataVehicleCompanyWithCompanyId($companyId);
        return $this->companyVideoRepository->getDataLatestCompanyVideoWithCompanyIdOrParentId($companyId, $childGroup->parent_id);
    }

    function getLatestPhotoAdsWorkedWithCompanyID($companyId)
    {
        $childGroup  = $this->vehicleCompanyRepository->getDataVehicleCompanyWithCompanyId($companyId);
        return $this->companyPhotoRepository->getLatestCompanyPhotoWithCompanyIdOrParentId($companyId, $childGroup->parent_id );
    }

    /**
     * @param Request $request
     * @return array
     */
    function insertHumanEvent(Request $request): array
    {
        $dataVehicle = $this->vehicleRepository-> getDataVehicleWithAppID($request->app_id);
        $video_latest = self::getLatestVideoAdsWorkedWithCompanyID($dataVehicle->company_id);
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $now = date("Y-m-d H:i:s");
        $result = $this->viewAdsVideoRepository->insertViewAdsVideo(
            $dataVehicle->id,
            $video_latest->id,
            $request->human_type,
            $now
        );

        return [
            'is_success'=>$result
        ];
    }
}

<?php

namespace App\Handlers;

use App\Repositories\CompanyVideo\CompanyVideoRepository;
use App\Repositories\Vehicle\VehicleRepository;
use App\Repositories\VehicleCompany\VehicleCompanyRepository;
use App\Repositories\ViewAdsVideo\ViewAdsVideoRepository;
use DateTime;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class DashBoardHandler
{
    public function __construct(
        private readonly VehicleCompanyRepository $vehicleCompanyRepository,
        private readonly VehicleRepository        $vehicleRepository,
        private readonly ViewAdsVideoRepository   $viewAdsVideoRepository,
        private readonly CompanyVideoRepository   $companyVideoRepository

    )
    {
    }

    /**
     * @return Factory|View|Application
     */
    function index(): Factory|View|Application
    {
        $parentGroups = $this->vehicleCompanyRepository->getVehicleCompanyParent();
        foreach($parentGroups as $parentGroup)
        {
            $childGroups = $this->vehicleCompanyRepository->getVehicleCompanySWithParentId($parentGroup->company_id);
            foreach($childGroups as $childGroup)
            {
                $childGroup->vehicles = $this->vehicleRepository->getVehicleWithCompanyID($childGroup->company_id);
            }
            $parentGroup->childGroups = $childGroups;
        }

        return view('Backend.main.dashboard.indexDashBoard')
            ->with(['parentGroups' =>$parentGroups
                ,'pagination' => 1]);
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    function getDataStatistics(Request $request): array
    {
        $text_search = $_POST['text-search'];
        $start_time = isset($_POST['start-time'])&&$_POST['start-time']!=-1?$_POST['start-time']:'00:00:00 01/01/1000';
        $end_time = isset($_POST['end-time'])&&$_POST['end-time']!=-1?$_POST['end-time']:'00:00:00 31/2/9999';

        $detectStatistics =  self::getDataSearch($text_search,$start_time,$end_time);

        return self::loadDrowsinessDetectionToStatistics($detectStatistics);
    }

    /**
     * @param String $text_search
     * @param String $start_time
     * @param String $end_time
     *
     * @return array
     */
    function getDataSearch(String $text_search, String $start_time, String $end_time): array
    {

        $data_tmp = $this->vehicleRepository->getVehicleWithVehicleNumber($text_search);

        if(isset($data_tmp)) {
            return self::getDataAllDrowsinessDetectionsVehicle_ID($data_tmp->id,$start_time,$end_time);
        }

        $words = explode('-',$text_search);

        if(count($words)==2) {
            $data_parent = self::getDataCompany_withNameGroup($words[0]);
        } else {
            return [];
        }

        if($data_parent) {
            $childGroups = $this->vehicleCompanyRepository->getVehicleCompanySWithParentId($data_parent->company_id);
            foreach($childGroups as $childGroup)
            {
                if(trim(strtolower($childGroup->company_group)) == trim(strtolower($words[1]))) {
                    $data_tmp = $childGroup;
                }
            }

        } else {
            return [];
        }

        if(isset($data_tmp)) {
            return self::getDataAllViewAdsVideo_withCompany_ID($data_tmp->company_id,$start_time,$end_time);
        } else {
            return [];
        }
    }

    /**
     * @param int $vehicleId
     * @param String $start_time
     * @param String $end_time
     * @return array
     */
    function getDataAllDrowsinessDetectionsVehicle_ID(int $vehicleId, String $start_time, String $end_time): array
    {
        return $this->viewAdsVideoRepository->getDataAllDrowsinessDetectionsVehicle_ID($vehicleId, $start_time,$end_time);
    }

    /**
     * @param String $name_group
     * @return mixed
     */
    function getDataCompany_withNameGroup(String $name_group): mixed
    {
        return $this->vehicleCompanyRepository->getVehicleCompanyWithNameGroup($name_group);
    }

    /**
     * @param int $company_id
     * @param String $start_time
     * @param String $end_time
     * @return array
     */
    function getDataAllViewAdsVideo_withCompany_ID(int $company_id, String $start_time, String $end_time): array
    {
        $dataAllViewAdsVideo =[];
        $vehicleIds =   $this->vehicleRepository->getVehicleWithCompanyID($company_id)->pluck('id')->toArray();

        $tmp_dataAllViewAdsVideo = self::getDataAllViewAdsVideo_withCompanyHasVideo_ID($vehicleIds, $start_time, $end_time);

        foreach($tmp_dataAllViewAdsVideo as $item)
        {
            $dataAllViewAdsVideo[] = $item;
        }

        return $dataAllViewAdsVideo;
    }

    /**
     * @param array $vehicleIds
     * @param String $startTime
     * @param String $endTime
     * @return Collection
     */
    function getDataAllViewAdsVideo_withCompanyHasVideo_ID(array $vehicleIds, String $startTime, String $endTime): Collection
    {
        return $this->viewAdsVideoRepository->getDataAllViewAdsVideoWithVehicleIds($vehicleIds, $startTime, $endTime);
    }

    /**
     * @param $detectStatistics
     *
     * @throws Exception
     *
     * @return array
     */
    function loadDrowsinessDetectionToStatistics($detectStatistics): array
    {
        $total_drowsiness_detections = count($detectStatistics);
        $drowsiness_frequency = [];

        $uniqueVehicleIds = array_unique(array_column($detectStatistics, 'vehicle_id'));

        $totalVehicles = count($uniqueVehicleIds);

        if($total_drowsiness_detections > 0) {
            $firstItem = reset($detectStatistics);
            $lastItem = end($detectStatistics);

            $start_time = new DateTime($firstItem->created_at);
            $end_time = new DateTime($lastItem->created_at);

            $interval = $start_time->diff($end_time);
            $period = $interval->days;

            $drowsiness_frequency = array_reduce($detectStatistics, function($carry, $item) use ($period) {
                $date = new DateTime($item->created_at);

                if ($period <= 1) {
                    $formatted_date = $date->format('Y-m-d h:i:s');
                } elseif ($period < 365) {
                    $formatted_date = $date->format('Y-m-d');
                } else {
                    $formatted_date = $date->format('Y-m');
                }

                if (!isset($carry[$formatted_date])) {
                    $carry[$formatted_date] = 0;
                }
                $carry[$formatted_date]++;
                return $carry;
            }, []);
        }


        return [
            'total_drowsiness_detections'=>$total_drowsiness_detections,
            'total_vehicle_drowsiness_detections'=>$totalVehicles,
            'drowsiness_frequency' => $drowsiness_frequency
        ];
    }
}

<?php

namespace App\Handlers;

use App\Repositories\CompanyVideo\CompanyVideoRepository;
use App\Repositories\Vehicle\VehicleRepository;
use App\Repositories\VehicleCompany\VehicleCompanyRepository;
use App\Repositories\ViewAdsVideo\ViewAdsVideoRepository;
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
     * @return array
     */
    function getDataStatistics(Request $request): array
    {
        $text_search = $_POST['text-search'];
        $start_time = isset($_POST['start-time'])&&$_POST['start-time']!=-1?$_POST['start-time']:'00:00:00 01/01/1000';
        $end_time = isset($_POST['end-time'])&&$_POST['end-time']!=-1?$_POST['end-time']:'00:00:00 31/2/9999';

        $viewAdsVideos =  self::getDataSearch($text_search,$start_time,$end_time);

        return self::loadViewAdsVideoToStatistics($viewAdsVideos);
    }

    function getDataSearch(String $text_search,String $start_time,String $end_time): array|Collection
    {

        $data_tmp = $this->vehicleRepository->getVehicleWithVehicleNumber($text_search);

        if(isset($data_tmp))
        {
            return self::getDataAllViewAdsVideo_withVehicle_ID($data_tmp->id,$start_time,$end_time);
        }
        // split text
        $words = explode('-',$text_search);
        if(count($words)==2)
        {
            $data_parent = self::getDataCompany_withNameGroup($words[0]);
        }
        else
        {
            return [];
        }

        if($data_parent)
        {
            $childGroups = $this->vehicleCompanyRepository->getVehicleCompanySWithParentId($data_parent->company_id);
            foreach($childGroups as $childGroup)
            {
                if(trim(strtolower($childGroup->company_group)) == trim(strtolower($words[1])))
                {
                    $data_tmp = $childGroup;
                }
            }

        }
        else
        {
            return [];
        }
        if(isset($data_tmp))
        {
            return self::getDataAllViewAdsVideo_withCompany_ID($data_tmp->company_id,$start_time,$end_time);
        }
        else
        {
            return [];
        }

    }

    /**
     * @param int $vehicleId
     * @param String $start_time
     * @param String $end_time
     * @return Collection
     */
    function getDataAllViewAdsVideo_withVehicle_ID(int $vehicleId, String $start_time, String $end_time): Collection
    {
        return $this->viewAdsVideoRepository->getAllDataViewWithVehicleIDBetweenTime($vehicleId, $start_time,$end_time);
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
        // $company = DashBoardController:: getDataCompany_withCompanyID($company_id);
        $dataGlobal = $this->companyVideoRepository->getDataAllCompanyVideoSWithCompanyID(0);
        $dataAllViewAdsVideo =[];
        $vehicles =   $this->vehicleRepository->getVehicleWithCompanyID($company_id);

        if(isset($dataGlobal) && count($dataGlobal))
        {
            foreach ($dataGlobal as $companies_has_video )
            {

                $tmp_dataAllViewAdsVideo = self::getDataAllViewAdsVideo_withCompanyHasVideo_ID($companies_has_video['id'],$start_time,$end_time);

                foreach($tmp_dataAllViewAdsVideo as $item)
                {
                    foreach($vehicles as $vehicle)
                    {
                        if($item->vehicle_id == $vehicle->id)
                        {
                            $dataAllViewAdsVideo[] = $item;
                        }
                    }

                }
            }
        }
        $companies_has_videos = $this->companyVideoRepository->getDataAllCompanyVideoSWithCompanyID($company_id);

        foreach ($companies_has_videos as $companies_has_video )
        {
            $tmp_dataAllViewAdsVideo = self::getDataAllViewAdsVideo_withCompanyHasVideo_ID($companies_has_video['id'],$start_time,$end_time);

            foreach($tmp_dataAllViewAdsVideo as $item)
            {
                $dataAllViewAdsVideo[] = $item;
            }
        }

        return $dataAllViewAdsVideo;
    }

    /**
     * @param int $companyVideoId
     * @param String $startTime
     * @param String $endTime
     * @return Collection
     */
    function getDataAllViewAdsVideo_withCompanyHasVideo_ID(int $companyVideoId, String $startTime, String $endTime): Collection
    {
        // dump($company_video_id);
        return $this->viewAdsVideoRepository->getDataAllViewAdsVideoWithCompanyHasVideoID($companyVideoId, $startTime, $endTime);
    }

    /**
     * @param $view_ads_video
     * @return array
     */
    function loadViewAdsVideoToStatistics($view_ads_video): array
    {
        $total_length_time_run =(object)[];
        $total_length_time_run->seconds = 0;
        $total_length_time_pause_image =(object)[];
        $total_length_time_pause_image->seconds = 0;
        $total_length_time_stop_app =(object)[];
        $total_length_time_stop_app->seconds = 0;
        $total_play_video = 0  ;
        $start_time_run = 0;
        $start_time_pause_image = 0;
        $session_time_pause_image = 0;
        $session_time_stop_app = 0;
        $start_time_stop_app = 0;
        for($i=0;$i<count($view_ads_video);$i++)
        {
            // dump($total_length_time_stop_app,$view_ads_video[$i]);
            if($view_ads_video[$i]->human_type==4)
            {
                $start_time_stop_app = strtotime($view_ads_video[$i]->human_time);
            }
            if($view_ads_video[$i]->human_type==-1&&$start_time_stop_app>0)
            {
                $total_length_time_stop_app->seconds += strtotime($view_ads_video[$i]->human_time)-$start_time_stop_app;
            }
            if($view_ads_video[$i]->human_type==1)
            {
                $start_time_run = strtotime($view_ads_video[$i]->human_time);
            }
            if($view_ads_video[$i]->human_type==0)
            {
                $total_length_time_run->seconds+=strtotime($view_ads_video[$i]->human_time) - $start_time_run - $session_time_pause_image;
                // dump(strtotime($view_ads_video[$i]->human_time),$start_time_run);
                $total_play_video++;
                // clear time session time pause img
                $session_time_pause_image=0;
            }
            if($view_ads_video[$i]->human_type ==2)
            {

                $start_time_pause_image = strtotime($view_ads_video[$i]->human_time);
            }
            if($view_ads_video[$i]->human_type ==3)
            {
                $session_time_pause_image += strtotime($view_ads_video[$i]->human_time) - $start_time_pause_image;
                $total_length_time_pause_image->seconds+=strtotime($view_ads_video[$i]->human_time) - $start_time_pause_image; ;
            }

        }
        $total_length_time_run->hours = (int)($total_length_time_run->seconds/60/60);
        $total_length_time_run->minutes = ($total_length_time_run->seconds/60%60);
        $total_length_time_run->seconds=$total_length_time_run->seconds%60;

        $total_length_time_pause_image->hours = (int)($total_length_time_pause_image->seconds/60/60);
        $total_length_time_pause_image->minutes = ($total_length_time_pause_image->seconds/60%60);
        $total_length_time_pause_image->seconds=$total_length_time_pause_image->seconds%60;

        $total_length_time_stop_app->hours = (int)($total_length_time_stop_app->seconds/60/60);
        $total_length_time_stop_app->minutes = ($total_length_time_stop_app->seconds/60%60);
        $total_length_time_stop_app->seconds=$total_length_time_stop_app->seconds%60;

        return [
            'total_play_video'=>$total_play_video,
            'total_length_time_run'=>$total_length_time_run,
            'total_length_time_pause_image'=>$total_length_time_pause_image,
            'total_length_time_stop_app'=>$total_length_time_stop_app,
        ];
    }
}

<?php

namespace App\Repositories\ViewAdsVideo;

use App\Models\VehicleVideoStatistics;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ViewAdsVideoRepository extends BaseRepository implements IViewAdsVideoRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return VehicleVideoStatistics::class;
    }


    /**
     * @param int $vehicleId
     * @param String $start_time
     * @param String $end_time
     * @return Collection
     */
    function getAllDataViewWithVehicleIDBetweenTime(int $vehicleId, String $start_time, String $end_time): Collection
    {
        return DB::table('taxi_video_statistics')
            ->where(['taxi_id'=>$vehicleId])
            ->whereBetween('human_time',[DB::raw("STR_TO_DATE('{$start_time}','%H:%i:%s %d/%m/%Y')"),DB::raw("STR_TO_DATE('{$end_time}','%H:%i:%s %d/%m/%Y')")])
            ->orderBy('id','ASC')
            ->get();
    }

    /**
     * @param int $companyVideoId
     * @param String $startTime
     * @param String $end_time
     * @return Collection
     */
    function getDataAllViewAdsVideoWithCompanyHasVideoID(int $companyVideoId, String $startTime, String $end_time): Collection
    {
        // dump($company_video_id);
        return DB::table('taxi_video_statistics')
            ->where(['company_video_id'=>$companyVideoId])
            ->whereBetween('human_time',[DB::raw("STR_TO_DATE('{$startTime}','%H:%i:%s %d/%m/%Y')"),DB::raw("STR_TO_DATE('{$end_time}','%H:%i:%s %d/%m/%Y')")])
            ->orderBy('id','ASC')
            ->get();
    }

    /**
     * @param int $vehicleId
     * @param int $companyVidedId
     * @param int $humanType
     * @param String $now
     * @return bool
     */
    function insertViewAdsVideo(int $vehicleId, int $companyVidedId, int $humanType, String $now): bool
    {
        return DB::statement("insert into `taxi_video_statistics` (`taxi_id`, `company_video_id`, `human_type`, `human_time`) values ({$vehicleId}, {$companyVidedId}, {$humanType},'{$now}')");
    }
}

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
     * @return array
     */
    function getDataAllDrowsinessDetectionsVehicle_ID(int $vehicleId, String $start_time, String $end_time): array
    {
        return DB::table('detect_statistics')
            ->where(['vehicle_id'=>$vehicleId])
            ->whereBetween('created_at',[DB::raw("STR_TO_DATE('{$start_time}','%H:%i:%s %d/%m/%Y')"),DB::raw("STR_TO_DATE('{$end_time}','%H:%i:%s %d/%m/%Y')")])
            ->orderBy('id','ASC')
            ->get()
            ->toArray();
    }

    /**
     * @param array $vehicleIds
     * @param String $startTime
     * @param String $end_time
     * @return Collection
     */
    function getDataAllViewAdsVideoWithVehicleIds(array $vehicleIds, String $startTime, String $end_time): Collection
    {
        return DB::table('detect_statistics')
            ->whereBetween('created_at',[DB::raw("STR_TO_DATE('{$startTime}','%H:%i:%s %d/%m/%Y')"),DB::raw("STR_TO_DATE('{$end_time}','%H:%i:%s %d/%m/%Y')")])
            ->whereIn('vehicle_id', $vehicleIds)
            ->orderBy('id','ASC')
            ->get();
    }

    /**
     * @param int $vehicleId
     * @param String $now
     *
     * @return bool
     */
    function insertViewAdsVideo(int $vehicleId, String $now): bool
    {
        return DB::statement("insert into `detect_statistics` (`vehicle_id`, `created_at`) values ({$vehicleId}, '{$now}')");
    }
}

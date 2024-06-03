<?php

namespace App\Repositories\VehicleVideoStatistics;

use App\Models\VehicleVideoStatistics;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class VehicleVideoStatisticsRepository extends BaseRepository implements IVehicleVideoStatisticsInterface
{
    /**
     * @return string
     */
    public function getModel(): string
    {
        return VehicleVideoStatistics::class;
    }

    /**
     * @param int $vehicleId
     * @return Collection
     */
    public function getVehicleVideoStatisticsIdWithVehicleId(int $vehicleId): Collection
    {
        return DB::table('detect_statistics')
            ->where(['vehicle_id' => $vehicleId])
            ->get(['id']);
    }
}

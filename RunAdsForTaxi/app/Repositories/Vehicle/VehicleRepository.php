<?php

namespace App\Repositories\Vehicle;

use App\Models\Vehicle;
use App\Models\VehicleCompany;
use App\Repositories\BaseRepository;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use stdClass;

class VehicleRepository extends BaseRepository implements IVehicleRepositoryInterface
{

    /**
     * @return string
     */
    public function getModel(): string
    {
        return Vehicle::class;
    }
    public function getVehicleSWithNumberVehicle(string $numberVehicle)
    {
        return $this->model->select('vehicle_num')->get();
    }

    /**
     * @param int $start
     * @param int $limit
     * @return Collection
     */
    function getAllVehicleForPage(int $start, int $limit) : Collection
    {
        return DB::table('vehicle')
            ->offset($start)->limit($limit)
            ->get(
                array(
                    'id',
                    'vehicle_num',
                    'company_id',
                    'tablet_id',
                    'sim_number',
                    'app_id'
                )
            );
    }

    /**
     * @param int $companyID
     * @param int $start
     * @param int $limit
     * @return Collection
     */
    function getVehicleWithCompanyIDForPage(int $companyID, int $start, int $limit) : Collection
    {
        return DB::table('vehicle')
            ->where(['company_id' => $companyID])
            ->offset($start)->limit($limit)
            ->get([
                'id',
                'vehicle_num',
                'company_id',
                'tablet_id',
                'sim_number',
                'app_id',
            ]);
    }

    /**
     * @param int $companyID
     * @return Collection
     */
    function getVehicleWithCompanyID(int $companyID) : Collection
    {
        return DB::table('vehicle')
            ->where(['company_id'=>$companyID])
            ->get([
                'id',
                'vehicle_num',
                'company_id',
                'tablet_id',
                'sim_number',
                'app_id',
            ]);
    }

    /**
     * @param int $companyId
     * @return Collection
     */
    function getVehicleCompanyWithCompanyID(int $companyId) : Collection
    {
        return DB::table('company')
            ->where('company_id', $companyId)
            ->get();
    }

    /**
     * @return Collection
     */
    function getSubVehicleCompany() : Collection
    {
        return DB::table('company')
            ->where('parent_id','>',0)
            ->get(
                array(
                    'company_id',
                    'company_group',
                    'parent_id',
                )
            );
    }


    /**
     * @param int $parentId
     * @return Collection
     */
    function getVehicleCompanyParent(int $parentId) : Collection
    {
        return DB::table('company')
            ->where(['company_id' => $parentId,'parent_id' => 0])
            ->get();
    }


    /**
     * @param $vehicleId
     * @return stdClass
     */
    function getDataVehicleWithID($vehicleId) : stdClass
    {
        return DB::table('vehicle')
            ->where(['id'=>$vehicleId])
            ->get(
                array(
                    'id',
                    'vehicle_num',
                    'company_id',
                    'tablet_id',
                    'sim_number',
                    'app_id'
                )
            )->first();
    }


    /**
     * @param int $vehicleId
     * @param String $vehicleNum
     * @param int $tabletId
     * @param String $appId
     * @return Collection|null
     */
    function getVehicleWithAnyParameter(int $vehicleId, String $vehicleNum, int $tabletId=-1, String $appId) : Collection|null
    {
        return DB::table('vehicle')
            ->where(function ($query) use ($vehicleNum,$tabletId,$appId)
            {
                $query->orWhereRaw("LOWER(TRIM(`vehicle_num`)) = '{$vehicleNum}'")
                    ->orWhereRaw( "LOWER(TRIM(`tablet_id`)) = '{$tabletId}'")
                    ->orWhereRaw( "LOWER(TRIM(`app_id`)) = '{$appId}'");
            })->where('id','!=',$vehicleId)->get()->first();
    }

    /**
     * @param String $password
     * @return stdClass|null
     */
    function checkPasswordAdmin(String $password) : stdClass|null
    {
        return DB::table('admin')
            ->where(['password_admin'=>$password])
            ->get()->first();
    }

    /**
     * @param String $vehicleNumber
     * @return Collection
     */
    function getVehicleLikeVehicleNumber(String $vehicleNumber): Collection
    {
        return DB::table('vehicle')
            ->where('vehicle_num','LIKE',"%{$vehicleNumber}%")
            ->get(
                array(
                    'id',
                    'vehicle_num',
                    'company_id',
                    'tablet_id',
                    'sim_number',
                    'app_id'
                )
            );
    }

    /**
     * @param String $vehicleNumber
     * @return stdClass|null
     */
    function getVehicleWithVehicleNumber(String $vehicleNumber): stdClass|null
    {
        return DB::table('vehicle')
            ->where('vehicle_num',$vehicleNumber)
            ->first();
    }

    /**
     * @param int $companyId
     * @return Collection
     */
    public function getVehicleIdWithCompanyId(int $companyId): Collection
    {
        return DB::table('vehicle')
                ->where(['company_id' => $companyId])
                ->get(['id']);
    }

    /**
     * @param String $appId
     * @return mixed
     */
    function getDataVehicleWithAppID(String $appId): mixed
    {
        return DB::table('vehicle')
            ->where(['app_id'=>$appId])->get()->first();
    }
}

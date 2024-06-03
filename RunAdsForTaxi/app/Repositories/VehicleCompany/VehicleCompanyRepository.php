<?php

namespace App\Repositories\VehicleCompany;

use App\Models\VehicleCompany;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class VehicleCompanyRepository extends BaseRepository implements IVehicleCompanyRepositoryInterface
{
    /**
     * @return string
     */
    public function getModel(): string
    {
        return VehicleCompany::class;
    }

    /**
     * @return Collection
     */
    public function getVehicleCompanyParent(): Collection
    {
        return DB::table('taxi_company')
            ->where(['parent_id'=> '0'])
            ->get(
                array(
                    'company_id',
                    'parent_id',
                    'company_group'
                )
            );
    }


    /**
     * @param int $parendId
     * @return Collection
     */
    public function getVehicleCompanySWithParentId(int $parendId): Collection
    {
        return DB::table('taxi_company')
            ->where(['parent_id'=> $parendId])
            ->get();
    }

    /**
     * @param String $company_group
     * @return int
     */
    public function insertVehicleCompanyParent(String $company_group): int
    {
        return DB::table('taxi_company')->insertGetId([
            'company_group' => $company_group,
            'parent_id' => 0
        ]);
    }
    /**
     * @param String $group_name
     * @param String $parentId
     * @return bool
     */
    public function insertVehicleCompanyChild(String $group_name, String $parentId): bool
    {
        return DB::table('taxi_company')->insert([
        'company_group' => $group_name,
        'parent_id' => $parentId
        ]);
    }

    /**
     * @param String $groupname
     * @param int $parentId
     * @return Collection
     */
    public function getVehicleCompanyWithGroupNameAndParentId(String $groupname, int $parentId): Collection
    {
        return DB::table('taxi_company')
            ->where(['company_group' => $groupname])
            ->where(['parent_id' => $parentId])
            ->get();
    }

    /**
     * @param String $companyGroup
     * @param int $companyId
     * @return int
     */
    public function updateCompanyGroupVehicleCompanyWithCompanyID(String $companyGroup, int $companyId): int
    {

      return   DB::table('taxi_company')
            ->where(['company_id' => $companyId])
            ->update([
                'company_group' => $companyGroup
            ]);
    }

    /**
     * @param int $companyId
     * @return Collection
     */
    public function getParentIdWithCompanyId(int $companyId): Collection
    {
        return DB::table('taxi_company')
            ->where(['company_id' => $companyId])
            ->get(['parent_id']);
    }

    /**
     * @param int $parentId
     * @return Collection
     */
    public function getCompanyIdWithParentId(int $parentId): Collection
    {
        return DB::table('taxi_company')
            ->where(['parent_id' => $parentId])
            ->get(['company_id']);
    }

    /**
     * @param int $companyId
     * @return Collection
     */
    public function getIdCompanyPhotoWithCompanyId(int $companyId): Collection
    {
        return DB::table('company_photo')
            ->where(['company_id' => $companyId])
            ->get(['id']);
    }

    /**
     * @param int $companyId
     * @return Collection
     */
    public function getIdCompanyVideoWithCompanyId(int $companyId): Collection
    {
        return DB::table('company_video')
            ->where(['company_id' => $companyId])
            ->get(['id']);
    }
    public function deleteVehicleCompanyWithCompanyID($companyId)
    {
        return  DB::table('taxi_company')
            ->where(['company_id'=>$companyId])
            ->delete();
    }

    /**
     * @param String $nameGroup
     * @return mixed
     */
    public function getVehicleCompanyWithNameGroup(String $nameGroup): mixed
    {
        $nameGroup = trim(strtolower($nameGroup));
        $lengthGameGroup =  strlen($nameGroup);
        return DB::table('taxi_company')
            ->whereRaw("LENGTH(TRIM(company_group)) = {$lengthGameGroup}")
            ->whereRaw( "LOWER(`company_group`) LIKE '{$nameGroup}'")
            ->get()->first();
    }

    /**
     * @param int $companyId
     * @return mixed
     */
    public function getDataVehicleCompanyWithCompanyId(int $companyId): mixed
    {
        return DB::table('taxi_company')
            ->where(['company_id'=>$companyId,
            ])
            ->get()->first();
    }
}

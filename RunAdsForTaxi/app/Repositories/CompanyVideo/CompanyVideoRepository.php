<?php

namespace App\Repositories\CompanyVideo;

use App\Models\CompanyVideo;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class CompanyVideoRepository extends BaseRepository implements ICompanyVideoRepositoryInterface
{
    /**
     * @return string
     */
    public function getModel(): string
    {
        return CompanyVideo::class;
    }
    function getCompanyVideoSWithCompanyID(int $companyID)
    {
        return CompanyVideo::select('*')->where(['company_id'=>$companyID])->orderBy('id', 'DESC')->take(1)->get()->toArray();
    }

    function getDataAllCompanyVideoSWithCompanyID(int $companyID)
    {
        return CompanyVideo::select('*')->where(['company_id'=>$companyID])->orderBy('id', 'DESC')->get()->toArray();
    }

    /**
     * @param int $companyId
     * @param int $parentId
     * @return mixed
     */
    function getDataLatestCompanyVideoWithCompanyIdOrParentId(int $companyId, int $parentId): mixed
    {
        return DB::table('company_video')
            ->where(['company_id'=>$companyId
            ])
            ->orWhere(['company_id'=>$parentId ] )
            ->orWhere(['company_id'=>0  ] )
            ->where(['is_active'=>1  ])
            ->orderBy('id','DESC')->get()->first();
    }

}

<?php

namespace App\Repositories\CompanyPhoto;

use App\Models\CompanyPhoto;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class CompanyPhotoRepository extends BaseRepository implements ICompanyPhotoRepositoryInterface
{
    /**
     * @return string
     */
    public function getModel(): string
    {
        return CompanyPhoto::class;
    }
    function getLatestCompanyPhotoSWithCompanyID(int $companyID)
    {
        return CompanyPhoto::select('*')->where(['company_id'=>$companyID])->orderBy('id', 'DESC')->get()->take(1)->toArray();
    }
    function getLatestCompanyPhotoWithCompanyIdOrParentId(int $companyId, $parentId)
    {
        return DB::table('company_photo')
            ->where(['company_id'=>$companyId
            ])
            ->orWhere(['company_id'=>$parentId] )
            ->orWhere(['company_id'=>0  ] )
            ->where(['is_active'=>1  ])
            ->orderBy('id','DESC')->get()->first();
    }
}

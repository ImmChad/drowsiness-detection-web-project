<?php

namespace App\Handlers;

use App\Repositories\CompanyPhoto\CompanyPhotoRepository;
use App\Repositories\CompanyVideo\CompanyVideoRepository;
use App\Repositories\Photo\PhotoRepository;
use App\Repositories\VehicleCompany\VehicleCompanyRepository;
use App\Repositories\Video\VideoRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Session;
class VideoAdsHandler
{
    public function __construct(
        private readonly CompanyVideoRepository     $companyVideoRepo
        , private readonly CompanyPhotoRepository   $companyPhotoRepo
        , private readonly VehicleCompanyRepository $vehicleCompanyRepository
        , private readonly VideoRepository          $videoRepository
        , private readonly PhotoRepository          $photoRepository
    )
    {}

    /**
     * @return Factory|View|Application
     */
    function showAddVideo(): Factory|View|Application
    {
        $dataCompany = self::getAllCompany();
        return view('Backend.main.videos_ads.add-video-ads')
            ->with(['pagination' => 4])
            ->with(['dataCompany' => $dataCompany]);
    }

    /**
     * @return array
     */
    function getAllCompany(): array
    {
        $dataCompany = $this->vehicleCompanyRepository->getVehicleCompanyParent();
        $ListGroup = [];
        foreach($dataCompany as $subDataCompany) {
            $getData = $this->vehicleCompanyRepository->getVehicleCompanySWithParentId($subDataCompany->company_id);
            $subDataCompany->parent_group = "null";
            $ListGroup[count($ListGroup)] = (object)$subDataCompany ;
            if(count($getData) > 0) {
                foreach($getData as $getSubData) {
                    $getSubData->parent_group = $subDataCompany->company_group;
                    $ListGroup[count($ListGroup)] = (object)$getSubData ;
                }
            }
        }

        $newListDataCompany = $ListGroup;

        return $newListDataCompany;
    }

    /**
     * @return Factory|View|Application
     */
    function showAllVideo(): Factory|View|Application
    {
        $dataVideo = $this->videoRepository->getAllVideoAdsNoDeletedAt();
        return view('Backend.main.videos_ads.all-video-ads')
            ->with(['dataVideo' => $dataVideo])
            ->with(['pagination' => 4]);
    }

    /**
     * @return Factory|View|Application
     */
    function showAllImage(): Factory|View|Application
    {
        $dataPhoto = $this->photoRepository->getAllPhotoNoDeletedAt();
        return view('Backend.main.videos_ads.all-image-ads')
            ->with(['dataPhoto' => $dataPhoto])
            ->with(['pagination' => 4]);
    }

    /**
     * @param Request $request
     * @param int $company_id
     * @return Factory|View|Application
     */
    function showListCompanyVideo(Request $request, int $company_id = 0): Factory|View|Application
    {
        $companyMedias['videos'] = $this->companyVideoRepo->getCompanyVideoSWithCompanyID($company_id);

        if(count($companyMedias['videos'])==0)
        {
            $companyMedias['videos'] = $this->companyVideoRepo->getCompanyVideoSWithCompanyID(0);
        }

        foreach ($companyMedias['videos'] as $key=>$data)
        {
            $companyMedias['videos'][$key]['detail'] = $this->videoRepository->find($data['video_id'])->toArray();
        }

        $companyMedias['photos'] = $this->companyPhotoRepo->getLatestCompanyPhotoSWithCompanyID($company_id);

        if(count($companyMedias['photos'])==0)
        {
            $companyMedias['photos'] = $this->companyPhotoRepo->getLatestCompanyPhotoSWithCompanyID(0);
        }

        foreach ($companyMedias['photos'] as $key=>$data)
        {
            $companyMedias['photos'][$key]['detail'] = $this->photoRepository->find($data['photo_id'])->toArray();
        }

        return view('Backend.main.videos_ads.list-company-video')->with(
            ['dataCompany'=>$this->vehicleCompanyRepository->getAll(),
                'companyMedias'=>$companyMedias,
                'companySelectedID'=>$company_id,
                'pagination' => 4]
        );
    }

    /**
     * @param Request $request
     * @param int $company_id
     * @return Factory|View|Application
     */
    function showListCompanyPhoto(Request $request, int $company_id = 0): Factory|View|Application
    {
        $companyMedias['photos'] = $this->companyPhotoRepo->getLatestCompanyPhotoSWithCompanyID($company_id);
        if(count($companyMedias['photos'])==0)
        {
            $companyMedias['photos'] = $this->companyPhotoRepo->getLatestCompanyPhotoSWithCompanyID(0);
        }
        foreach ($companyMedias['photos'] as $key=>$data)
        {
            $companyMedias['photos'][$key]['detail'] = $this->photoRepository->find($data['photo_id'])->toArray();
        }

        return view('Backend.main.videos_ads.list-company-photo')->with(
            ['dataCompany'=>$this->vehicleCompanyRepository->getAll(),
                'companyMedias'=>$companyMedias,
                'companySelectedID'=>$company_id,
                'pagination' => 4]
        );
    }

    /**
     * @param Request $request
     * @return mixed
     */
    function updateCompanyVideoImage(Request $request): mixed
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $resultCompanyVideo = $this->companyVideoRepo->create(
            [
                'company_id' => $request->company_id,
                'video_id' => $request->video_id,
                'change_time' => $request->change_time,
                'is_active' => 1,
                'created_at' => date('Y/m/d H:i:s')
            ]
        );
        $resultCompanyPhoto = $this->companyPhotoRepo->create(
            [
                'company_id' => $request->company_id,
                'photo_id' => $request->photo_id,
                'is_active' => 1,
                'created_at' => date('Y/m/d H:i:s')
            ]
        );

        return $resultCompanyVideo;
    }

    /**
     * @param Request $request
     * @return boolean
     */
    function addVideoInMedia(Request $request): bool
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $get_video = $request->file('video_path');

        if($get_video){
            $tmp_path = Storage::disk('s3')->put('public/videos',$get_video);
            $video_path = Storage::disk('s3')->url($tmp_path);
            $resultVideo = $this->videoRepository->create(
                [
                    'video_name' => $request->video_name,
                    'video_description' => $request->video_description,
                    'video_length' => $request->video_length,
                    'video_thumbnail' => $request->video_thumbnail,
                    'video_path' => $video_path,
                    'created_at' => date('Y/m/d H:i:s')
                ]
            );

            return isset($resultVideo);
        }
        else
        {
            return false;
        }
    }

    /**
     * @param Request $request
     * @return false
     */
    function addImageInMedia(Request $request): bool
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $get_image = $request->file('photo_path');

        if($get_image){
            $photo_file_path = Storage::disk('s3')->put('public/images', $get_image);
            $photo_path = Storage::disk('s3')->url($photo_file_path);
            $resultPhoto = $this->photoRepository->create([
                'photo_name' => $request->photo_name,
                'photo_description' => $request->photo_description,
                'photo_path' => $photo_path,
                'created_at' => date('Y/m/d H:i:s')
            ]);

            return isset($resultPhoto);
        }
        else
        {
            return false;
        }
    }

    /**
     * @param Request $request
     * @return int|string|RedirectResponse
     */
    function deleteVideoInMedia(Request $request): int|string|RedirectResponse
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $infoAdmin = Session::get('infoAdmin');
            $video_id = $request->video_id;
            $password_admin = $request->password_admin;

            if($password_admin == $infoAdmin->password_admin) {
                // dd($video_id);
                return $this->videoRepository->update($video_id,
                    ['deleted_at' => date('Y/m/d H:i:s')]
                );
            } else {

                return "Your password is wrong ?!";
            }
    }


    /**
     * @param Request $request
     * @return bool|string
     */
    function deleteImageInMedia(Request $request): bool|string
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $infoAdmin = Session::get('infoAdmin');
        $photo_id = $request->photo_id;
        $password_admin = $request->password_admin;

        if($password_admin == $infoAdmin->password_admin) {
            // dd($video_id);
            return $this->photoRepository->update($photo_id,
                ['deleted_at' => date('Y/m/d H:i:s')]
            );
        } else {
            return "Your password is wrong ?!";
        }
    }

    /**
     * @return Collection
     */
    function getAllVideoAds(): Collection
    {
        return $this->videoRepository->getAllVideoAdsNoDeletedAt();
    }

    /**
     * @return Collection
     */
    function getAllPhoto(): Collection
    {
        return $this->photoRepository->getAllPhotoNoDeletedAt();
    }
}

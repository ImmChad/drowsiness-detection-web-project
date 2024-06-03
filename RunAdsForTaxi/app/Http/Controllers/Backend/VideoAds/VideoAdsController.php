<?php

namespace App\Http\Controllers\Backend\VideoAds;

use App\Handlers\VideoAdsHandler;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Aws\S3\Enum\Group;
use Illuminate\Support\Collection;
use Session;

class VideoAdsController extends Controller
{
    /**
     * @param VideoAdsHandler $videoAdsHandler
     */
    public function __construct(private readonly VideoAdsHandler $videoAdsHandler)
    {
    }

    /**
     * @return View|Factory|Application
     */
    function showAddVideo(): View|Factory|Application
    {
             return $this->videoAdsHandler->showAddVideo();
    }

    /**
     * @return Factory|View|Application
     */
    function showAllVideo(): Factory|View|Application
    {
            return $this->videoAdsHandler->showAllVideo();
    }

    /**
     * @return View|Factory|Application
     */
    function showAllImage(): View|Factory|Application
    {
            return $this->videoAdsHandler->showAllImage();
    }


    /**
     * @param Request $request
     * @return mixed
     */
    function updateCompanyVideoImage(Request $request): mixed
    {

        return $this->videoAdsHandler->updateCompanyVideoImage($request);
    }

    /**
     * @param Request $request
     * @return bool
     */
    function addVideoInMedia(Request $request): bool
    {
        return $this->videoAdsHandler->addVideoInMedia($request);
    }

    /**
     * @param Request $request
     * @return bool
     */
    function addImageInMedia(Request $request): bool
    {
        return $this->videoAdsHandler->addImageInMedia($request);
    }


    /**
     * @param Request $request
     * @return int|string|RedirectResponse
     */
    function deleteVideoInMedia(Request $request): int|string|RedirectResponse
    {
        return $this->videoAdsHandler->deleteVideoInMedia($request);
    }

    /**
     * @param Request $request
     * @return bool|string
     */
    function deleteImageInMedia(Request $request): bool|string
    {
        return $this->videoAdsHandler->deleteImageInMedia($request);
    }


    /**
     * @param Request $request
     * @param int $company_id
     * @return View|Factory|Application
     */
    function showListCompanyVideo(Request $request, int $company_id = 0): View|Factory|Application
    {
        return $this->videoAdsHandler->showListCompanyVideo($request,$company_id);
    }

    /**
     * @param Request $request
     * @param int $company_id
     * @return View|Factory|Application
     */
    function showListCompanyPhoto(Request $request, int $company_id = 0): View|Factory|Application
    {
        return $this->videoAdsHandler->showListCompanyPhoto($request,$company_id);
    }

    /**
     * @return Collection
     */
    function getAllVideoAds(): Collection
    {
        return $this->videoAdsHandler->getAllVideoAds();
    }

    /**
     * @return Collection
     */
    function getAllPhoto(): Collection
    {
        return $this->videoAdsHandler->getAllPhoto();
    }
}

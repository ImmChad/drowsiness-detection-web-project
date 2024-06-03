<?php

namespace App\Http\Controllers\Backend\ViewAdsVideo;

use App\Handlers\ViewAdsVideoHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewAdsVideoController extends Controller
{
    /**
     * @param ViewAdsVideoHandler $viewAdsVideoHandler
     */
    public function __construct(private readonly ViewAdsVideoHandler $viewAdsVideoHandler)
    {
    }

    /**
     * @param Request $request
     * @return array
     */
    function getAllVideoWithAppID(Request $request): array
    {
        return $this->viewAdsVideoHandler->getAllVideoWithAppID($request);
    }

    /**
     * @param Request $request
     * @return array
     */
    function insertHumanEvent(Request $request): array
    {
        return $this->viewAdsVideoHandler->insertHumanEvent($request);
    }
}

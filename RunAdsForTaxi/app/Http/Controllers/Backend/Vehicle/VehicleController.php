<?php

namespace App\Http\Controllers\Backend\Vehicle;

use App\Handlers\VehicleHandler;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Session;

class VehicleController extends Controller
{

    /**
     * @param VehicleHandler $vehicleHandler
     */
    public function __construct(private readonly VehicleHandler $vehicleHandler)
    {}

    /**
     * @return View|Factory|Redirector|RedirectResponse|Application
     */
    function showAllVehicle(): View|Factory|Redirector|RedirectResponse|Application
    {
       return $this->vehicleHandler->showAllVehicle();
    }

    /**
     * @param $vehicleId
     * @return Factory|View|Application
     */
    function showUpdateVehicle($vehicleId): Factory|View|Application
    {
            return $this->vehicleHandler->showUpdateVehicle($vehicleId);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    function searchVehicleByVehicleNumber(Request $request): \Illuminate\Http\JsonResponse
    {
        $result = $this->vehicleHandler->getDataVehicleLikeVehicleNumber($request->post("textVehicleNumber"));
        return response()->json(['data'=>$result]);
    }


    /**
     * @param Request $request
     * @return array
     */
    function updateVehicle(Request $request): array
    {
        return $this->vehicleHandler->updateVehicle($request);
    }


    /**
     * @return Factory|View|Application
     */
    function showAddVehicle(): Factory|View|Application
    {
            return $this->vehicleHandler->showAddVehicle();
    }

    /**
     * @param Request $request
     * @return array
     */
    function addVehicle(Request $request): array
    {
        return $this->vehicleHandler->addVehicle($request);
    }

    /**
     * @param Request $request
     * @return array
     */
    function deleteVehicle(Request $request): array
    {
        return $this->vehicleHandler->deleteVehicle($request);
    }


}

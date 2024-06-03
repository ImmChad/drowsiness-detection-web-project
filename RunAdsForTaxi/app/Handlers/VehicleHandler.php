<?php

namespace App\Handlers;

use App\Repositories\Vehicle\VehicleRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class VehicleHandler
{
    /**
     * @param VehicleRepository $vehicleRepository
     */
    public function __construct(private readonly VehicleRepository $vehicleRepository)
    {
    }


    /**
     * @return View|Factory|Redirector|RedirectResponse|Application
     */
    function showAllVehicle(): View|Factory|Redirector|RedirectResponse|Application
    {
        // check existed query filter url
        $page = $_GET['page'] ?? 1;
        $limit = $_GET['afficher'] ?? 20;
        $filter_company_id = $_GET['filter_company_id'] ?? -1;
        // process result
        $start = ($page - 1) * $limit;

        $listDataVehicle = self::getAllVehicle_withCompany_ID($filter_company_id, $start, $limit);
        $result_total = count(self::getAllVehicle_withCompany_ID($filter_company_id));
        $total_content = count(self::getAllVehicle_withCompany_ID($filter_company_id));

        $total_page = $total_content / $limit;

        if (round($total_page) < $total_page) {
            $total_page = $total_page + 1;
        }

        $total_page = round($total_page);

        // get info company for each vehicle
        $listVehicle = [];

        foreach ($listDataVehicle as $subListVehicle) {
            $company_group = $this->vehicleRepository->getVehicleCompanyWithCompanyID($subListVehicle->company_id);
            $subListVehicle->company_group = ($company_group[0]->company_group);
            $city = $this->vehicleRepository->getVehicleCompanyWithCompanyID($company_group[0]->parent_id);
            $subListVehicle->city = ($city[0]->company_group);
            $listVehicle[count($listVehicle)] = $subListVehicle;
        }

        $newListDataVehicle = $listVehicle;

        // move to Page-- with after filter company present page no result
        if (count($newListDataVehicle) == 0 && isset($_GET['page']) && $_GET['page'] > 1) {
            $page_reduce = (int)$_GET['page'] - 1;
            return redirect("/vehicle/all-vehicle?page={$page_reduce}&filter_company_id={$_GET['filter_company_id']}");
        }

        return view('backend.main.vehicle.all-vehicle')
            ->with([
                'dataAllCompanyMinimum' => self::getAllCompanyMinimum(),
                'pagination' => 2,
                'page' => $page,
                'total_page' => $total_page,
                'afficher' => $limit,
                'result_total' => $result_total,
                'filter_company_id' => $filter_company_id,
                'listDataVehicle' => $newListDataVehicle,
            ]);
    }


    /**
     * @param $vehicleId
     * @return Factory|View|Application
     */
    function showUpdateVehicle($vehicleId): Factory|View|Application
    {

        $dataVehicle = $this->vehicleRepository->getDataVehicleWithID($vehicleId);
        $dataVehicle->dataGroupCompany = self::getMinimumCompanyWithID($dataVehicle->company_id);

        return view('backend.main.vehicle.update-vehicle')
            ->with(['pagination' => 2])
            ->with(['dataVehicle' => $dataVehicle])
            ->with(['dataAllCompanyMinimum' => self::getAllCompanyMinimum()]);
    }


    /**
     * @return array
     */
    function getAllCompanyMinimum(): array
    {
        $dataCompanies = $this->vehicleRepository->getSubVehicleCompany();
        $dataAllCompanyMinimum = [];
        foreach ($dataCompanies as $dataCompany) {
            $dataAllCompanyMinimum[count($dataAllCompanyMinimum)] = self::getMinimumCompanyWithID($dataCompany->company_id);
        };
        return $dataAllCompanyMinimum;
    }


    /**
     * @param int $companyId
     * @return Collection|\stdClass
     */
    function getMinimumCompanyWithID(int $companyId): Collection|\stdClass
    {
        $dataCompany = $this->vehicleRepository->getVehicleCompanyWithCompanyID($companyId)->first();
        $dataCompany->dataParent = $this->vehicleRepository->getVehicleCompanyParent($dataCompany->parent_id)->first();

        return $dataCompany;
    }


    function getAllVehicle_withCompany_ID($company_id, $start = -1, $limit = -1): Collection
    {
        if ($company_id > -1) {
            if ($start == -1 || $limit == -1) {
                return $this->vehicleRepository->getVehicleWithCompanyID($company_id);
            }

            return $this->vehicleRepository->getVehicleWithCompanyIDForPage($company_id, $start, $limit);
        } else {
            if ($start == -1 || $limit == -1) {
                return $this->vehicleRepository->getAll();
            }

            return $this->vehicleRepository->getAllVehicleForPage($start, $limit);
        }
    }


    /**
     * @param Request $request
     * @return array
     */
    function updateVehicle(Request $request): array
    {
        $result = false;

        if (!self::checkExistVehicleForUpdate($request->value_vehicle_id,
            trim(strtolower($request->value_vehicle_number)),
            trim(strtolower($request->value_tablet_id))
            , trim(strtolower($request->value_app_id)))) {
            $result = $this->vehicleRepository->update($request->value_vehicle_id,
                [
                    'vehicle_num' => $request->value_vehicle_number,
                    'company_id' => $request->value_group_id,
                    'tablet_id' => $request->value_tablet_id,
                    'sim_number' => $request->value_number_phone,
                    'app_id' => $request->value_app_id,]
            );
            return [
                'isSuccess' => $result,
                'mess' => 'Success Update Vehicle'
            ];
        } else {
            return [
                'isSuccess' => false,
                'mess' => 'Vehicle Number or Tablet ID or App ID Existed'
            ];
        }

    }


    /**
     * @param int $vehicleId
     * @param String $vehicleNum
     * @param int $tabletId
     * @param String $appId
     * @return bool
     */
    function checkExistVehicleForUpdate(int $vehicleId, string $vehicleNum, int $tabletId = -1, string $appId): bool
    {

        $dataVehicle = $this->vehicleRepository->getVehicleWithAnyParameter($vehicleId, $vehicleNum, $tabletId, $appId);

        return isset($dataVehicle);
    }


    /**
     * @return Factory|View|Application
     */
    function showAddVehicle(): Factory|View|Application
    {
        $tmpDataCompanies = [];
        $dataCompanies = self::getAllCompanyMinimum();

        foreach ($dataCompanies as $dataCompany) {
            $tmpDataCompanies[] = self::getMinimumCompanyWithID($dataCompany->company_id);
        }
        return view('backend.main.vehicle.add-vehicle')
            ->with(['pagination' => 2])
            ->with(['dataAllCompanyMinimum' => $dataCompanies]);
    }

    /**
     * @param Request $request
     * @return array
     */
    function addVehicle(Request $request): array
    {
        $result = 0;
        // check existed vehicle

        if (!self::checkExistVehicleForAdd(trim(strtolower($request->value_vehicle_number)))) {
            $timeInt = strtotime(date("Y-m-d H:i:s"));
            $result = $this->vehicleRepository->create(
                [
                    'vehicle_num' => $request->value_vehicle_number,
                    'company_id' => $request->value_group_id,
                    'tablet_id' => $timeInt,
                    'sim_number' => $request->value_number_phone,
                    'app_id' => "Vehicle{$timeInt}",
                ]
            );
            return [
                'isSuccess' => $result,
                'mess' => 'Success Add Vehicle'
            ];
        } else {
            return [
                'isSuccess' => $result,
                'mess' => 'Vehicle Number Existed'
            ];
        }
    }

    /**
     * @param int $vehicleNum
     * @return bool
     */
    function checkExistVehicleForAdd(int $vehicleNum = -1): bool
    {
        $dataVehicle = DB::table('vehicle')
            ->whereRaw("LOWER(TRIM(`vehicle_num`)) = '{$vehicleNum}'")
            ->get()->first();
        return isset($dataVehicle);
    }

    /**
     * @param Request $request
     * @return array
     */
    function deleteVehicle(Request $request): array
    {

        if (self::checkPassWordAdmin($request->password_admin)) {
            $resultDeleteVehicle = $this->vehicleRepository->delete($request->vehicle_id);
            return [
                'isSuccess' => $resultDeleteVehicle,
                'mess' => 'Success Delete Vehicle!!!'
            ];
        } else {
            return [
                'isSuccess' => 0,
                'mess' => 'Wrong Password!'
            ];
        }

    }

    /**
     * @param String $password
     * @return bool
     */
    function checkPassWordAdmin(string $password): bool
    {
        $dataAdmin = $this->vehicleRepository->checkPasswordAdmin($password);
        return isset($dataAdmin);
    }

    /**
     * @param String $vehicleNumber
     * @return Collection
     */
    function getDataVehicleLikeVehicleNumber(string $vehicleNumber): Collection
    {
        return $this->vehicleRepository->getVehicleLikeVehicleNumber($vehicleNumber);
    }
}

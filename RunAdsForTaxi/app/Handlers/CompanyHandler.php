<?php

namespace App\Handlers;

use App\Repositories\CompanyPhoto\CompanyPhotoRepository;
use App\Repositories\CompanyVideo\CompanyVideoRepository;
use App\Repositories\Vehicle\VehicleRepository;
use App\Repositories\VehicleCompany\VehicleCompanyRepository;
use App\Repositories\VehicleVideoStatistics\VehicleVideoStatisticsRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
class CompanyHandler
{
    /**
     * @param VehicleCompanyRepository $companyRepository
     * @param CompanyPhotoRepository $companyPhotoRepository
     * @param CompanyVideoRepository $companyVideoRepository
     * @param VehicleRepository $vehicleRepository
     * @param VehicleVideoStatisticsRepository $vehicleVideoStatisticsRepository
     */
    public function __construct(
        private readonly VehicleCompanyRepository         $companyRepository,
        private readonly CompanyPhotoRepository           $companyPhotoRepository,
        private readonly CompanyVideoRepository           $companyVideoRepository,
        private readonly VehicleRepository                $vehicleRepository,
        private readonly VehicleVideoStatisticsRepository $vehicleVideoStatisticsRepository)
    {

    }

    /**
     * @return Factory|View|Application
     */
    public function showAddCompany(): Factory|View|Application
    {
        return view('Backend.main.companys.add-company')
            ->with(['pagination' => 3]);
    }

    /**
     * @return Factory|View|Application
     */
    public function showAllCompany(): Factory|View|Application
    {
        $listDataCompany = self::getAllCompany();
        $result_total = count($listDataCompany);

        $page = $_GET['page'] ?? 1;
        // $page = count($listDataProduct);
        $limit = $_GET['afficher'] ?? 20;

        $start = ($page - 1) * $limit;
        $total_content = count($listDataCompany);
        $total_page = $total_content / $limit;

        if(round($total_page) < $total_page) {
            $total_page = $total_page + 1;
        }
        $total_page = round($total_page);

        $listDataCompany = self::getAllCompanyForPage($start, $limit);

        return view('Backend.main.companys.all-company')
            ->with(['pagination' => 3])
            ->with(['page' => $page])
            ->with(['afficher' => $limit])
            ->with(['result_total' => $result_total])
            ->with(['total_page' => $total_page])
            ->with(['listDataCompany' => $listDataCompany]);

    }

    /**
     * @return array
     */
    public function getAllCompany(): array
    {
        $dataCompany = $this->companyRepository->getVehicleCompanyParent();

        $ListGroup = [];
        foreach($dataCompany as $subDataCompany) {
            $getData = $this->companyRepository->getVehicleCompanySWithParentId($subDataCompany->company_id);
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
     * @param $start
     * @param $limit
     * @return array
     */
    public function getAllCompanyForPage($start, $limit): array
    {
        $dataCompany = $this->companyRepository->getVehicleCompanyParent();

        $ListGroup = [];
        foreach($dataCompany as $subDataCompany) {
            $getData = $this->companyRepository->getVehicleCompanySWithParentId($subDataCompany->company_id);

            $subDataCompany->parent_group = "null";
            $ListGroup[count($ListGroup)] = (object)$subDataCompany ;
            if(count($getData) > 0) {
                foreach($getData as $getSubData) {
                    $getSubData->parent_group = $subDataCompany->company_group;
                    $ListGroup[count($ListGroup)] = (object)$getSubData ;
                }
            }
        }

        $ListGroup = array_slice($ListGroup, $start, $limit);

        $newListDataCompany = $ListGroup;

        return $newListDataCompany;
    }

    /**
     * @param Request $request
     * @return int
     */
    function addNewCompany(Request $request): int
    {
        $companyId = $this->companyRepository->insertVehicleCompanyParent($request->company_group);
        $listGroup = json_decode($request->listGroup);

        foreach($listGroup as $subListGroup) {
            $this->companyRepository->insertVehicleCompanyChild($subListGroup->group_name,$companyId);
        }

        return $companyId;
    }

    function updateNewCompany(Request $request)
    {
        $listGroup = json_decode($request->listGroup);
        $this->companyRepository->updateCompanyGroupVehicleCompanyWithCompanyID(
            $request->company_group, $request->company_id
        );

        if(count($listGroup) > 0) {

            $count = 0;
            foreach($listGroup as $subListGroup) {
                $name_company_group = $this->companyRepository->getVehicleCompanyWithGroupNameAndParentId($subListGroup->group_name,$request->company_id) ;

                if( count($name_company_group) > 0 ) {
                    unset($listGroup[$count]);
                }
                $count = $count + 1;
            }

            if($listGroup > 0) {
                foreach($listGroup as $subListGroup) {
                    $this->companyRepository->insertVehicleCompanyChild($subListGroup->group_name,$request->company_id);
                }
            }

        }
        return $listGroup;
    }

    function deleteCompany(Request $request) {
        $infoAdmin = Session::get('infoAdmin');
        $company_id = $request->company_id;
        $password_admin = $request->password_admin;

        if($password_admin == $infoAdmin->password_admin)
        {
            $parent_id = $this->companyRepository->getParentIdWithCompanyId($company_id);

            if( $parent_id[0]->parent_id == 0 ) {
                $dataParentCompany = $this->companyRepository->getCompanyIdWithParentId($company_id);

                if(count($dataParentCompany) > 0) {
                    foreach($dataParentCompany as $subDataParentCompany) {
                        // query all COMPANY PHOTO
                        $dataCompanyPhoto = $this->companyRepository->getIdCompanyPhotoWithCompanyId($subDataParentCompany->company_id);

                        // delete COMPANY PHOTO
                        if(count($dataCompanyPhoto) > 0){
                            foreach($dataCompanyPhoto as $subDataCompanyPhoto) {
                                $this->companyPhotoRepository->delete($subDataCompanyPhoto->id);
                            }
                        }
                        // query all COMPANY VIDEO
                        $dataCompanyVideo = $this->companyRepository->getIdCompanyVideoWithCompanyId($subDataParentCompany->company_id);

                        if(count($dataCompanyVideo) > 0) {
                            foreach($dataCompanyVideo as $subDataCompanyVideo) {
                                $this->companyVideoRepository->delete($subDataCompanyVideo->id);
                            }
                        }

                        // find query all Vehicle from COMPANY GROUP
                        $dataVehicle = $this->vehicleRepository->getVehicleIdWithCompanyId($subDataParentCompany->company_id);

                        // select and delete all Vehicle VIDEO STATISTICS
                        if(count($dataVehicle) > 0) {

                            foreach($dataVehicle as $subDataVehicle) {
                                $vehicleVideoStatisticsIdWithVehicleId = $this->vehicleVideoStatisticsRepository->getVehicleVideoStatisticsIdWithVehicleId($subDataVehicle->id);

                                if(count($vehicleVideoStatisticsIdWithVehicleId) > 0) {
                                    foreach($vehicleVideoStatisticsIdWithVehicleId as $subGetIdVehicleVideoStatistics){
                                        $this->vehicleVideoStatisticsRepository->delete($subGetIdVehicleVideoStatistics->id);
                                    }
                                }

                                $this->vehicleRepository->delete($subDataVehicle->id);
                            }
                        }

                        $this->companyRepository->deleteVehicleCompanyWithCompanyID($subDataParentCompany->company_id);

                    }
                }

                DB::table('taxi_company')
                    ->where(['company_id' => $company_id])
                    ->delete();
            }
            else
            {
                // query all COMPANY PHOTO
                $dataCompanyPhoto = $this->companyRepository->getIdCompanyPhotoWithCompanyId($company_id);

                // delete COMPANY PHOTO
                if(count($dataCompanyPhoto) > 0){

                    foreach($dataCompanyPhoto as $subDataCompanyPhoto) {
                        $this->companyPhotoRepository->delete($subDataCompanyPhoto->id);
                    }
                }
                // query all COMPANY VIDEO
                $dataCompanyVideo = $this->companyRepository->getIdCompanyVideoWithCompanyId($company_id);

                if(count($dataCompanyVideo) > 0) {
                    foreach($dataCompanyVideo as $subDataCompanyVideo) {
                        $this->companyVideoRepository->delete($subDataCompanyVideo->id);
                    }

                }
                // find query all VEHICLE from COMPANY GROUP
                $dataVehicle = $this->vehicleRepository->getVehicleIdWithCompanyId($company_id);

                // select and delete all VEHICLE VIDEO STATISTICS
                if(count($dataVehicle) > 0) {

                    foreach($dataVehicle as $subVehicle) {
                        $vehicleVideoStatisticsIdWithVehicleId = $this->vehicleVideoStatisticsRepository->getVehicleVideoStatisticsIdWithVehicleId($subVehicle->id);

                        if(count($vehicleVideoStatisticsIdWithVehicleId) > 0) {

                            foreach($vehicleVideoStatisticsIdWithVehicleId as $subGetIdVehicleVideoStatistics){
                                $this->vehicleVideoStatisticsRepository->delete($subGetIdVehicleVideoStatistics->id);
                            }

                        }

                        $this->vehicleRepository->delete($subVehicle->id);
                    }
                }


                $this->companyRepository->deleteVehicleCompanyWithCompanyID($company_id);

            }

            return $company_id;
        }
        else {
            return "Your password is wrong ?!";
        }
    }
}

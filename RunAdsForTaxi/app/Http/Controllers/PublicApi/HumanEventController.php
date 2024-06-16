<?php

namespace App\Http\Controllers\PublicApi;

use App\Handlers\HumanEventHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HumanEventController extends Controller
{
    /**
     * @param HumanEventHandler $humanEventHandler
     */
    public function __construct(private readonly HumanEventHandler $humanEventHandler)
    {
    }

    /**
     * @param Request $request
     * @return array
     */
    function login(Request $request): array
    {
        return $this->humanEventHandler->login($request);
    }

    /**
     * @param Request $request
     * @return array
     */
    function insertHumanEvent(Request $request): array
    {
        return $this->humanEventHandler->insertHumanEvent($request);
    }
}

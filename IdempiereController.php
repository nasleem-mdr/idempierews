<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Uthadehikaru\IdempiereWS\ModelADService;

class IdempiereController extends Controller
{
    public function __construct()
    {
      //$this->test_route_home = $testRoute;

    }

    public function index()
    {
        $service = new ModelADService();
        $datas = $service->query(request()->get('name'))->execute()->to_array();     
        return view('idempiere.query', compact('datas'))->render();
    }

}

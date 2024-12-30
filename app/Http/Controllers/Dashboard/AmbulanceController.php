<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Ambulances\AmbulanceRepositoryInterface;
use App\Models\Ambulance;
use Illuminate\Http\Request;

class AmbulanceController extends Controller
{
    public $ambulance;

    public function __construct(AmbulanceRepositoryInterface $ambulance)
    {
        $this->ambulance = $ambulance;
    }

    public function index()
    {
        return $this->ambulance->index();
    }


    public function create()
    {
        return $this->ambulance->create();
    }


    public function store(Request $request)
    {
        return $this->ambulance->store($request);
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        return $this->ambulance->edit($id);
    }


    public function update(Request $request, $id)
    {
        return $this->ambulance->update($request, $id);
    }


    public function destroy($id)
    {
        return $this->ambulance->destroy($id);
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Patients\PatientRepositoryInterface;
use Illuminate\Http\Request;

class PatientController extends Controller
{

    private $patient;

    public function __construct(PatientRepositoryInterface $patient)
    {
        $this->patient = $patient;
    }

    public function index()
    {
        return $this->patient->index();
    }


    public function create()
    {
        return $this->patient->create();
    }


    public function store(Request $request)
    {
        return $this->patient->store($request);
    }


    public function show($id)
    {
        return $this->patient->show($id);
    }


    public function edit($id)
    {
        return $this->patient->edit($id);
    }


    public function update(Request $request, $id)
    {
        return $this->patient->update($request, $id);
    }


    public function destroy($id)
    {
        return $this->patient->destroy($id);
    }
}

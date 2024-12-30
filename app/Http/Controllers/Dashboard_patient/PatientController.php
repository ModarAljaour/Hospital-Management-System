<?php

namespace App\Http\Controllers\Dashboard_patient;

use App\Http\Controllers\Controller;
use App\Interfaces\Dashboard_patient\PatientRepositoryInterface;
use Illuminate\Http\Request;

class PatientController extends Controller
{

    private $patient;

    public function __construct(PatientRepositoryInterface $patient)
    {
        $this->patient = $patient;
    }


    public function invoice()
    {
        return $this->patient->invoice();
    }

    public function payment(){
        return $this->patient->payment();
    }

    public function view_ray($id)
    {
        return $this->patient->view_ray($id);
    }

    public function laboratory()
    {
        return $this->patient->laboratory();
    }

    public function ray()
    {
        return $this->patient->ray();
    }

    public function view_laboratory($id)
    {
        return $this->patient->view_laboratory($id);
    }

    public function destroy($id)
    {
        //return $this->patient->index($id);
        //
    }
}

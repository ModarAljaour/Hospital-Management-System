<?php

namespace App\Interfaces\Dashboard_patient;

interface PatientRepositoryInterface
{
    public function invoice();

    public function view_ray($id);

    public function view_laboratory($id);

    public function ray();

    public function payment();

    public function laboratory();
}

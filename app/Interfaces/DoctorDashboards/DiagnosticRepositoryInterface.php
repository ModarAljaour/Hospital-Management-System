<?php

namespace App\Interfaces\DoctorDashboards;

interface DiagnosticRepositoryInterface
{
    public function store($request);

    //show
    public function show($id);

    // addReview
    public function addReview($request);
}

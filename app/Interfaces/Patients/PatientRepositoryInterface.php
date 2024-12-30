<?php

namespace App\Interfaces\Patients;

interface PatientRepositoryInterface
{
    // get Patient
    public function index();

    // create Patient
    public function create();

    // store Patient
    public function store($request);

    // Edit Patient
    public function edit($id);

    // show Patient
    public function show($id);
    // update Patient
    public function update($request , $id);

    // destroy Patient
    public function destroy($request);

    // update_password Patient
    // public function update_password($request);

    // update_status Patient
    // public function update_status($request);
}

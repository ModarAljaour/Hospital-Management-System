<?php

namespace App\Interfaces\Ambulances;

interface AmbulanceRepositoryInterface
{
    public function index();

    // create Ambulances
    public function create();

    // store Ambulances
    public function store($request);

    // Edit Ambulances
    public function edit($id);
    // update Ambulances
    public function update($request , $id);

    // destroy Ambulances
    public function destroy($request);
}

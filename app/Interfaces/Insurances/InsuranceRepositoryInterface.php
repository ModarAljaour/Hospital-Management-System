<?php

namespace App\Interfaces\Insurances;

interface InsuranceRepositoryInterface
{
    public function index();

    public function create();

    public function store($request);

    public function update($request, $id);

    public function edit($id);

    public function destroy($id);

    // public function show($id);
}

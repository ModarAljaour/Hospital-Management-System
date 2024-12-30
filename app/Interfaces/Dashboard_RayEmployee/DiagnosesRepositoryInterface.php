<?php

namespace App\Interfaces\Dashboard_RayEmployee;

interface DiagnosesRepositoryInterface
{
    public function index();

    public function completed();

    public function store($request);

    public function edit($id);

    public function show($id);

    public function update($request, $id);

    public function destroy($id);
}

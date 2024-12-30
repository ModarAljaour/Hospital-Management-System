<?php

namespace App\Interfaces\Dashboard_Laboratory;

interface LaboratoryRepositoryInterface
{
    public function index();

    public function completed();

    public function edit($id);

    public function show($id);

    public function update($request, $id);

    public function destroy($id);
}

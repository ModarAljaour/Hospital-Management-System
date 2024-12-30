<?php

namespace App\Interfaces\DoctorDashboards;

interface RayRepositoryInterface
{
    public function store($request);

    //show
    public function update($request, $id);

    // addReview
    public function destroy($id);
}

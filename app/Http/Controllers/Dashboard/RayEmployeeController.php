<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\RayEmployee\RayEmployeeRepositoryInterface;
use Illuminate\Http\Request;

class RayEmployeeController extends Controller
{
    private $rayemployee;

    public function __construct(RayEmployeeRepositoryInterface $rayemployee)
    {
        $this->rayemployee = $rayemployee;
    }

    public function index()
    {

        return $this->rayemployee->index();
    }

    public function store(Request $request)
    {

        return $this->rayemployee->store($request);
    }

    public function update(Request $request, $id)
    {

        return $this->rayemployee->update($request, $id);
    }

    public function destroy($id)
    {

        return $this->rayemployee->destroy($id);
    }
}

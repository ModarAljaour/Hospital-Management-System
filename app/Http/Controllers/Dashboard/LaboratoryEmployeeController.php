<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\LaboratoryEmployee\LaboratoryEmployeeRepositoryInterface;
use Illuminate\Http\Request;

class LaboratoryEmployeeController extends Controller
{
    private $laboratory;

    public function __construct(LaboratoryEmployeeRepositoryInterface $laboratory)
    {
        $this->laboratory = $laboratory;
    }

    public function index()
    {

        return $this->laboratory->index();
    }

    public function store(Request $request)
    {

        return $this->laboratory->store($request);
    }

    public function update(Request $request, $id)
    {

        return $this->laboratory->update($request, $id);
    }

    public function destroy($id)
    {

        return $this->laboratory->destroy($id);
    }
}

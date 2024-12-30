<?php

namespace App\Http\Controllers\Dashboard_Ray_Employee;

use App\Http\Controllers\Controller;
use App\Interfaces\Dashboard_RayEmployee\DiagnosesRepositoryInterface;

use Illuminate\Http\Request;

class DiagnosesController extends Controller
{

    private $ray;

    public function __construct(DiagnosesRepositoryInterface $ray)
    {
        $this->ray = $ray;
    }


    public function index()
    {
        return $this->ray->index();
    }

    public function completed()
    {
        return $this->ray->completed();
    }


    public function store(Request $request)
    {
        return $this->ray->store($request);
    }

    public function edit($id)
    {
        return $this->ray->edit($id);
    }

    public function show($id)
    {
        return $this->ray->show($id);
    }

    public function update(Request $request, $id)
    {
        return $this->ray->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->ray->index($id);
        //
    }
}

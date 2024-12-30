<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\InsuranceRequest;
use App\Interfaces\Insurances\InsuranceRepositoryInterface;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    private $insurance;

    public function __construct(InsuranceRepositoryInterface $insurance)
    {
        $this->insurance = $insurance;
    }

    public function index()
    {
        return $this->insurance->index();
    }

    public function create()
    {
        return $this->insurance->create();
    }

    public function store(InsuranceRequest $request)
    {
        return $this->insurance->store($request);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return $this->insurance->edit($id);
    }

    public function update(Request $request, $id)
    {
        return $this->insurance->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->insurance->destroy($id);
    }
}

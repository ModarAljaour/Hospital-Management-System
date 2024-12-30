<?php

namespace App\Http\Controllers\Dashboard_Laboratory;

use App\Http\Controllers\Controller;
use App\Interfaces\Dashboard_Laboratory\LaboratoryRepositoryInterface;
use Illuminate\Http\Request;

class LaboratoryController extends Controller
{

    private $lab;

    public function __construct(LaboratoryRepositoryInterface $lab)
    {
        $this->lab = $lab;
    }


    public function index()
    {
        return $this->lab->index();
    }

    public function completed()
    {
        return $this->lab->completed();
    }


    public function store(Request $request)
    {
        return $this->lab->store($request);
    }

    public function edit($id)
    {
        return $this->lab->edit($id);
    }

    public function show($id)
    {
        return $this->lab->show($id);
    }

    public function update(Request $request, $id)
    {
        return $this->lab->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->lab->index($id);
        //
    }
}

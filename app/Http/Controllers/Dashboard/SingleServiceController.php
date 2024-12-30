<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SingleServiceRequest;
use App\Interfaces\Services\SingleServiceRepositoryInterface;
use Illuminate\Http\Request;

class SingleServiceController extends Controller
{
    private $singleService;

    public function __construct(SingleServiceRepositoryInterface $singleService)
    {
        $this->singleService = $singleService;
    }

    public function index()
    {
        return $this->singleService->index();
    }

    public function store(SingleServiceRequest $request)
    {
        return $this->singleService->store($request);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        return $this->singleService->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->singleService->destroy($id);
    }
}

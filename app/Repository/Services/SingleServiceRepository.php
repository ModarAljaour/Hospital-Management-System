<?php


namespace App\Repository\Services;

use App\Interfaces\Services\SingleServiceRepositoryInterface;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class SingleServiceRepository implements SingleServiceRepositoryInterface
{
    public function index()
    {
        $services = Service::orderby('id', 'desc')->get();
        return view('Dashboard.Services.Single Service.index', compact('services'));
    }
    public function store($request)
    {
        try {
            $serviceData = [
                'description' => $request->description,
                'price' => $request->price,
                'status' => 1,
                'name' => $request->name,
            ];

            $services = Service::create($serviceData);

            DB::commit();

            session()->flash('add');
            return redirect()->route('service.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request, $id)
    {
        try {
            $SingleService = Service::findOrFail($id);
            $SingleService->price = $request->price;
            $SingleService->description = $request->description;
            $SingleService->status = $request->status;
            $SingleService->save();

            // store trans
            $SingleService->name = $request->name;
            $SingleService->save();

            session()->flash('edit');
            return redirect()->route('service.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $services = Service::findOrFail($id);
            $services->delete();
            session()->flash('delete');
            return redirect()->route('service.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}

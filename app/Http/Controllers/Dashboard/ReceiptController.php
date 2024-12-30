<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Receipts\ReceiptRepositoryInterface;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    private $receipts;

    public function __construct(ReceiptRepositoryInterface $receipts)
    {
        $this->receipts = $receipts;
    }
    public function index()
    {
        return $this->receipts->index();
    }

    public function create()
    {
        return $this->receipts->create();
    }

    public function store(Request $request)
    {
        return $this->receipts->store($request);
    }

    public function show($id)
    {
        return $this->receipts->show($id);
    }

    public function edit($id)
    {
        return $this->receipts->edit($id);
    }

    public function update(Request $request, $id)
    {
        return $this->receipts->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->receipts->destroy($id);
    }
}

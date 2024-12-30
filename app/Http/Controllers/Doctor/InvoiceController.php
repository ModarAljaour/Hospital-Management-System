<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Interfaces\DoctorDashboards\InvoiceRepositoryInterface;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    private $invoice;

    public function __construct(InvoiceRepositoryInterface $invoice)
    {
        $this->invoice = $invoice;
    }

    public function index()
    {
        return $this->invoice->index();
    }

    public function completedinvoice()
    {
        return $this->invoice->completedinvoice();
    }

    public function reviewinvoice()
    {
        return $this->invoice->reviewinvoice();
    }

    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        return $this->invoice->show($id);
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

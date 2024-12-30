<?php

namespace App\Interfaces\DoctorDashboards;

interface InvoiceRepositoryInterface
{
    public function index();
    public function show($id);
    public function reviewinvoice();
    public function completedinvoice();
}

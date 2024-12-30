<?php

namespace App\Interfaces\Receipts;

interface ReceiptRepositoryInterface
{
    public function index();

    // create Receipt
    public function create();

    // store Receipt
    public function store($request);

    // Edit Receipt
    public function edit($id);

    // show Receipt
    public function show($id);
    // update Receipt
    public function update($request, $id);

    // destroy Receipt
    public function destroy($request);
}

<?php

namespace App\Interfaces\Sections;

interface SectionRepositoryInterface
{
    public function index();

    public function department();

    public function store($request);

    public function update($request);

    public function destroy($id);

    public function show($id);
}

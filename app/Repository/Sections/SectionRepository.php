<?php

namespace App\Repository\Sections;

use App\Interfaces\Sections\SectionRepositoryInterface;
use App\Models\Section;

class SectionRepository  implements SectionRepositoryInterface
{
    public function index()
    {
        $sections = Section::all();
        return view('Dashboard.Sections.index', compact('sections'));
    }

    public function department()
    {
        $departments = Section::all();
        return view('WebSite.layouts.department', compact('departments'));
    }

    public function store($request)
    {
        Section::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);
        session()->flash('add');

        return redirect()->route('section.index');
    }

    public function show($id)
    {
        $section = Section::with('doctors')->findOrFail($id);
        return view('Dashboard.Sections.show_doctors', compact('section'));
    }

    public function update($request)
    {

        $section = Section::findOrFail($request->id);
        $section->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        session()->flash('edit');

        return redirect()->route('section.index');
    }

    public function destroy($id)
    {
        Section::findOrFail($id)->delete();
        session()->flash('delete');
        return redirect()->route('section.index');
    }
}

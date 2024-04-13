<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSectionRequest;
use App\Models\Section;

class SectionController extends Controller
{

    public function index()
    {
        $sections = Section::all();
        return view('Dashboard.Sections.index', compact('sections'));
    }

    public function store(StoreSectionRequest $request)
    {
        Section::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        session()->flash('add');
        return redirect()->route('Sections.index');
    }

    public function show($id)
    {
        $doctors = Section::findOrFail($id)->doctors;
        $section = Section::findOrFail($id);
        return view('Dashboard.Sections.show_doctors', compact('doctors', 'section'));
    }

    public function update(StoreSectionRequest $request, $id)
    {
        $Sections = Section::find($id);

        $Sections->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        session()->flash('add');
        return redirect()->route('Sections.index');
    }

    public function destroy($id)
    {
        Section::findOrFail($id)->delete();
        session()->flash('delete');
        return redirect()->route('Sections.index');
    }
}

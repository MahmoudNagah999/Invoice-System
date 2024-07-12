<?php

namespace App\Http\Controllers;

use App\Models\sections;
use Illuminate\Http\Request;
use App\Http\Requests\Sections\StoreSectionRequest;
use App\Http\Requests\Sections\UpdateSectionRequest;


class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = sections::all();
        return view('sections.sections', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSectionRequest $request)
    {
        $validatedData = $request->validated([]);

        $data = $request->all();

        // $exist = sections::where('section_name', '=', $data['section_name'])->exists();
        // if ($exist) {
        //     session()->flash('Error', 'هذا القسم موجود مسبقا');
        //     return redirect('/sections');
        // } else {
            sections::create([
                'section_name' => $data['section_name'],
                'description' => $data['description'],
                'created_by' => (auth()->user()->name), 
            ]);
            session()->flash('Add', 'تمت العملية بنجاح');
            return redirect('/sections');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit(sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSectionRequest $request)
    {
        $id = $request->id;
        $validatedData = $request->validated([]);
        
        $section = sections::find($id);
        $section->update([
            'section_name' => $request->section_name,
            'description' => $request->description,
            'updated_by' => (auth()->user()->name), 
        ]);
        session()->flash('Edit', 'Edit Successfully');
        return redirect('/sections');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $section = sections::find($id);
        $section->delete();
        session()->flash('Delete', 'Delete Successfully');
        return redirect('/sections');
    }
}

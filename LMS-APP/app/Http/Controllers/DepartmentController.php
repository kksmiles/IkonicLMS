<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $departments = Department::paginate(8);
        return view('department.index', compact('departments'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create()
    {
        return view('department.create');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['string', 'required', 'unique:departments', 'max:255'],
            'description' => ['nullable', 'max:255'],
            'image' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024']
        ]);

        if($request->hasFile('image')) {
            $extension = $request->image->extension();
            $request->image->storeAs('/public/departments', $attributes['name'].".".$extension);
            $url = Storage::url("departments/".$attributes['name'].".".$extension);
            $attributes['image']=$url;
        }

        Department::create($attributes);
        return redirect(route('departments.index'))->with('success', 'Department created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */


    public function show(Department $department)
    {        
        return view('department.show', compact('department'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */


    public function edit(Department $department)
    {
        return view('department.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, Department $department)
    {
        $attributes = $request->validate([
            'name' => ['string', 'required', Rule::unique('departments')->ignore($department->id), 'max:255'],
            'description' => ['nullable', 'max:255'],
            'image' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024']
        ]);

        if($request->hasFile('image')) {
            $extension = $request->image->extension();
            $request->image->storeAs('/public/departments', $attributes['name'].".".$extension);
            $url = Storage::url("departments/".$attributes['name'].".".$extension);
            $attributes['image']=$url;
            $department->image = $attributes['image'];
        }
        
        $department->name = $attributes['name'];
        $department->description = $attributes['description'];
        $department->save();
        return redirect(route('departments.index'))->with('success', 'Department updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */


    public function destroy(Department $department)
    {
        $department->delete();
        return redirect(route('departments.index'))->with('success', 'Department deleted successfully');
    }
}

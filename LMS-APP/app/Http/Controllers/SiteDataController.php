<?php

namespace App\Http\Controllers;

use App\Models\SiteData;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteDataController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(SiteData::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }
    public function home()
    {
        $courses = Course::paginate(5);
        $site_datas = SiteData::all();
        $temp = new SiteData();
        return view('home', compact('courses', 'site_datas', 'temp'));
    }
    public function dashboard()
    {
        $courses = Course::paginate(6);
        return view('dashboard', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('site-datas.create');
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
            'title' => ['required', 'max:255'],
            'file' => ['required', 'mimes:pdf'],
        ]);

        if($request->hasFile('file')) {
            $current_time = \Carbon\Carbon::now()->timestamp;
            $extension = $request->file->extension();
            $request->file->storeAs('/public/site-datas', $current_time."".$attributes['title'].".".$extension);
            $url = Storage::url("site-datas/".$current_time."".$attributes['title'].".".$extension);
            $attributes['file']=$url;
        }

        SiteData::create($attributes);
        return redirect(route('home'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SiteData  $siteData
     * @return \Illuminate\Http\Response
     */
    public function edit(SiteData $siteData)
    {
        return view('site-datas.edit', compact('siteData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SiteData  $siteData
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SiteData $siteData)
    {
        $attributes = $request->validate([
            'title' => ['required', 'max:255'],
            'file' => ['nullable', 'mimes:pdf'],
        ]);
        if($request->hasFile('file')) {
            $current_time = \Carbon\Carbon::now()->timestamp;
            $extension = $request->file->extension();
            $request->file->storeAs('/public/site-datas', $current_time."".$attributes['title'].".".$extension);
            $url = Storage::url("site-datas/".$current_time."".$attributes['title'].".".$extension);
            $siteData->file=$url;
        }
        $siteData->title= $attributes['title'];
        $siteData->save();
        return redirect(route('home'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SiteData  $siteData
     * @return \Illuminate\Http\Response
     */
    public function destroy(SiteData $siteData)
    {
        $siteData->delete();
        return redirect(route('home'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class BatchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');   
        $this->authorizeResource(Batch::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $batches = Batch::paginate(8);
        return view('batches.index', compact('batches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('batches.create');
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
            'name' => ['string', 'required', 'unique:batches', 'max:255'],
            'description' => ['nullable', 'max:255'],
            'image' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024']
        ]);
        $current_timestamp = Carbon::now()->timestamp;
        if($request->hasFile('image')) {
            $image_name = $current_timestamp . "_" . $request->image->getClientOriginalName();
            $extension = $request->image->extension();
            $request->image->storeAs('/public/batches', $image_name .".". $extension);
            $url = Storage::url("batches/". $image_name .".". $extension);
            $attributes['image']=$url;
        }

        Batch::create($attributes);
        return redirect(route('batches.index'))->with('success', 'Batches created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function show(Batch $batch)
    {
        return view('batches.show', compact('batch'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function edit(Batch $batch)
    {
        return view('batches.edit', compact('batch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Batch $batch)
    {
        $attributes = $request->validate([
            'name' => ['string', 'required', 'unique:batches', 'max:255'],
            'description' => ['nullable', 'max:255'],
            'image' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024']
        ]);
        $current_timestamp = Carbon::now()->timestamp;
        if($request->hasFile('image')) {
            $image_name = $current_timestamp . "_" . $request->image->getClientOriginalName();
            $extension = $request->image->extension();
            $request->image->storeAs('/public/batches', $image_name .".". $extension);
            $url = Storage::url("batches/". $image_name .".". $extension);
            $attributes['image']=$url;
            $batch->image = $attributes['image'];
        }

        $batch->name = $attributes['name'];
        $batch->description = $attributes['description'];
        $batch->save();
        return redirect(route('batches.index'))->with('success', 'Batch updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Batch $batch)
    {
        $batch->delete();
        return redirect(route('batches.index'))->with('success', 'Batch deleted successfully');
    }

    public function removeUser(Request $request)
    {
        User::find($request['learner_id'])->batches()->detach($request['batch_id']);
        return redirect(route('batches.show', $request['batch_id']))->with('success', 'User removed successfully');
    }

    public function addUser($id)
    {
        $batch = Batch::findOrFail($id);
        $users = User::where('role', 3)->get();
        return view('batches.add-user', compact('batch', 'users'));
    }
    public function storeUser(Request $request)
    {
        $batch = Batch::find($request['batch_id']);
        $batch->learners()->sync($request['users']);
        return redirect(route('batches.show', $request['batch_id']))->with('success', 'Users enrolled successfully');
    }
}

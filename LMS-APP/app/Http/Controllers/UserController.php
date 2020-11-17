<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('role'))
        {
            $users = User::where('role', $request->role)->paginate(8);
        }
        else {
            $request->role = 1;
            $users = User::where('role', $request->role)->paginate(8);
        }
        return view('users.index')->with('users', $users)->with('role', $request->role);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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
            'role' => ['numeric'],
            'full_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'unique:users', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'],
            'phone' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024']
        ]);
        
        $current_timestamp = Carbon::now()->timestamp;
        if($request->hasFile('image')) {
            $image_name = $current_timestamp . "_" . $request->image->getClientOriginalName();
            $extension = $request->image->extension();
            $request->image->storeAs('/public/profiles', $image_name .".". $extension);
            $url = Storage::url("profiles/". $image_name .".". $extension);
            $attributes['image']=$url;
        }
        $attributes['password'] = Hash::make($request['password']);
        User::create($attributes);
        return redirect(route('users.index'))->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $attributes = $request->validate([
            'role' => ['numeric'],
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024']
        ]);
        $current_timestamp = Carbon::now()->timestamp;
        if($request->hasFile('image')) {
            $image_name = $current_timestamp . "_" . $request->image->getClientOriginalName();
            $extension = $request->image->extension();
            $request->image->storeAs('/public/profiles', $image_name .".". $extension);
            $url = Storage::url("profiles/". $image_name .".". $extension);
            $attributes['image']=$url;
            $user->image = $attributes['image'];
        }
        $user->role = $attributes['role'];
        $user->full_name = $attributes['full_name'];
        $user->email = $attributes['email'];
        $user->phone = $attributes['phone'];
        $user->save();
        return redirect(route('users.index'))->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
    }
}

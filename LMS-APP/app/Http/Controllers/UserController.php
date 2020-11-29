<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth')->except('show');   
        $this->authorizeResource(User::class);
    }
    public function index(Request $request)
    {
        if($request->has('role'))
        {
            session(['role' => $request->role]);
            $users = User::where('role', session('role'))->paginate(8);
        }
        else if(session('role')) {
            $users = User::where('role', session('role'))->paginate(8);
        } else {
            session(['role' => 1]);
            $users = User::where('role', session('role'))->paginate(8);
        }
        return view('users.index')->with('users', $users);
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $attributes = $request->validate([
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
        $user->full_name = $attributes['full_name'];
        $user->email = $attributes['email'];
        $user->phone = $attributes['phone'];
        $user->save();
        return redirect(route('users.index'))->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('users.index'))->with('success', 'User deleted successfully');
    }

    public function gradebook()
    {
        return view('users.gradebook');
    }
}

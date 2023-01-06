<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('user.view', User::class);
        return view('user.index', ['users' => User::all()->where('is_doctor', '=', false)]);
    }

    public function edit()
    {
        return view('user.edit', ['user' => Auth::user()]);
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $this->authorize('user.edit', [$user]);

        $user->fill($request->validated());
        if ($request->hasFile('profile_img')) {
            $fname = $request->file('profile_img')->storeAs('images/profile_images/' . $request->user()->id, $request->file('profile_img')->getClientOriginalName());
            $user->image()->save(
                Image::make(['src' => $fname])
            );
        }
        $user->save();
        return redirect()->route('dashboard');
    }
}

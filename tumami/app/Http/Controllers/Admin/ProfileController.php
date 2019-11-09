<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Profile;
class ProfileController extends Controller
{
    public function add()
    {
        return view('admin.profile.create');
    }
    public function create(Request $request)
    {
        $this->validate($request, Profile::$rules);
        $profile = new Profile;
        $form = $request->all();
        $profile->fill($form);
        $profile->save();
        return redirect('admin/profile/create');
    }
    public function edit(Request $request)
    {
        $profile = Profile::find($request->id);
        if (empty($profile)) {
            abort(404);
        }
        return view('admin.profile.edit', ['profile_form' => $profile]);
    }

    public function update(Request $request)
    {
        $this->validate($request, Profile::$rules);
        $profile = Profile::find($request->id);
        $profile_form = $request->all();
        if (isset($profile_form['userimage_path'])) {
            $path = $request->file('userimage_path')->store('public/userimage_path');
            $profile->image_path = basename($path);
            unset($profile_form['userimage_path']);
        } elseif (0 == strcmp($request->remove, 'userimage_path')) {
            $profile->video = null;
        }
        unset($profile_form['_token']);
        unset($profile_form['remove']);
        $profile->fill($profile_form)->save();
        return view('admin.profile.edit');
    }

    public function show(Request $request)
    {
        $user = \Auth::user();
        $user_id = $user->id;
        $profile = Profile::find($request->user_id);
        if (empty($profile)) {
            abort(404);
        }
        return view('admin.profile.show', ['profile' => $profile, 'user_id' => $user_id]);
    }

}

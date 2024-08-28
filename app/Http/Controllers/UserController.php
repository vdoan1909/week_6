<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Services\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    protected $profileService;

    const PATH_VIEW = 'client.users.';

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function show()
    {
        $user = $this->profileService->showProfile();
        // dd($user);
        $this->authorize('view', $user);

        return view(self::PATH_VIEW . __FUNCTION__, compact('user'));
    }

    public function edit()
    {
        $user = $this->profileService->showProfile();
        // dd($user);
        $this->authorize('view', $user);

        return view(self::PATH_VIEW . __FUNCTION__, compact('user'));
    }

    public function update(UpdateProfileRequest $request)
    {
        // dd($request->all());
        $data = $request->validated();
        // dd($data);

        $user = $this->profileService->showProfile();
        $this->authorize('update', $user);

        $updated = $this->profileService->updateProfile($data);

        if ($updated) {
            return redirect()->route('client.profile.show')->with('success', 'Update profile successfully');
        }else{
            return redirect()->route('client.profile.show')->with('error', 'Update profile failed');
        }
    }
}

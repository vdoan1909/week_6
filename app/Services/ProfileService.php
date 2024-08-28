<?php
namespace App\Services;

use App\Repositories\ProfileRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileService
{
    protected $profileRepository;

    const PATH_UPLOAD = 'users';

    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function showProfile()
    {
        return $this->profileRepository->showProfile();
    }

    public function updateProfile(array $data)
    {
        $user = $this->profileRepository->showProfile();
        $current_avatar = $user->avatar;

        $data = [
            'bio' => $data["bio"],
            'date_of_birth' => $data["date_of_birth"],
            'avatar' => $data["avatar"]
        ];

        try {
            DB::beginTransaction();
            $profileUpdateSuccess = $this->profileRepository->updateProfile($data);

            if ($profileUpdateSuccess && $data["avatar"]) {
                if ($current_avatar && Storage::exists($current_avatar)) {
                    Storage::delete($current_avatar);
                }

                $newAvatar = Storage::put(self::PATH_UPLOAD, $data["avatar"]);
                $this->profileRepository->updateProfile(['avatar' => $newAvatar]);
            } else {
                $data["avatar"] = $current_avatar;
            }

            DB::commit();
            return $profileUpdateSuccess;
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
        }
    }
}
<?php
namespace App\Repositories;

use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class ProfileRepository extends BaseRepository
{
    protected $model;

    public function __construct(Profile $model)
    {
        parent::__construct($model);
    }

    public function showProfile()
    {
        return $this->model->where('user_id', Auth::user()->id)->first();
    }

    public function updateProfile(array $data){

        return $this->model->where('user_id', Auth::user()->id)->update($data);
    }
}
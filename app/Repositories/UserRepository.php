<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository extends BaseRepository
{
    protected $model;

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function getPostByUser()
    {
        return $this->model->where("id", Auth::user()->id)->with('posts')->get();
    }
}
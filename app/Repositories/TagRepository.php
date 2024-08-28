<?php
namespace App\Repositories;

use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class TagRepository extends BaseRepository
{
    protected $model;

    public function __construct(Tag $model)
    {
        parent::__construct($model);
    }

    public function getTagByUser(){
        return $this->model->where('user_id', Auth::user()->id)->select('id', 'name')->get();
    }
}
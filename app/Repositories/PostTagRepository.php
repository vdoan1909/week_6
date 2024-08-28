<?php
namespace App\Repositories;

use App\Models\PostTag;

class PostTagRepository extends BaseRepository
{
    protected $model;

    public function __construct(PostTag $model)
    {
        parent::__construct($model);
    }
}
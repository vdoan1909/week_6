<?php
namespace App\Repositories;

use App\Models\Post;

class PostRepository extends BaseRepository
{
    protected $model;

    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    public function findBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();

    }

    public function getPostTagBySlug($slug)
    {
        return $this->model->where('slug', $slug)->with('tags')->first();

    }

    public function updateBySlug($slug, array $data)
    {
        $post = $this->findBySlug($slug);
        $post->update($data);
        return $post;
    }

    public function deleteBySlug($slug)
    {
        $post = $this->findBySlug($slug);
        return $post->delete();
    }

    public function searchPostByTitle($title)
    {
        return $this->model->where('title', 'LIKE', '%' . $title . '%')->get();
    }

    public function searchPostByTag($name)
    {
        $posts = $this->model->whereHas('tags', function ($query) use ($name) {
            $query->where('name', $name);
        })->get();

        return $posts;
    }
}
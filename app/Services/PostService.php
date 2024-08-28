<?php
namespace App\Services;

use App\Repositories\PostRepository;
use App\Repositories\TagRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostService
{
    protected $postRepository;
    protected $tagRepository;

    public function __construct(PostRepository $postRepository, TagRepository $tagRepository)
    {
        $this->postRepository = $postRepository;
        $this->tagRepository = $tagRepository;
    }

    public function all()
    {
        return $this->postRepository->all();
    }

    public function create(array $data)
    {
        try {
            DB::beginTransaction();

            $post = $this->postRepository->create(
                [
                    'user_id' => Auth::user()->id,
                    'title' => $data['title'],
                    'slug' => Str::slug($data['title']),
                    'content' => $data['content'],
                ]
            );

            if (!empty($data['tags'])) {
                $post->tags()->sync($data['tags']);
            }

            DB::commit();

            return $post;
        } catch (\Throwable $th) {
            DB::rollBack();
            // dd($th);
            return false;
        }
    }

    public function findBySlug($slug)
    {
        return $this->postRepository->findBySlug($slug);
    }

    public function getPostTagBySlug($slug)
    {
        return $this->postRepository->getPostTagBySlug($slug);
    }

    public function updateBySlug($slug, array $data)
    {
        try {
            DB::beginTransaction();

            $post = $this->postRepository->updateBySlug(
                $slug,
                [
                    'user_id' => Auth::user()->id,
                    'title' => $data['title'],
                    'slug' => Str::slug($data['title']),
                    'content' => $data['content'],
                ]
            );

            if (!empty($data['tags'])) {
                $post->tags()->sync($data['tags']);
            }

            DB::commit();

            return $post;
        } catch (\Throwable $th) {
            DB::rollBack();
            // dd($th);
            return false;
        }
    }

    public function deleteBySlug($slug)
    {
        $this->postRepository->deleteBySlug($slug);
        return true;
    }

    public function searchPostByTitle($title)
    {
        return $this->postRepository->searchPostByTitle($title);
    }

    public function searchPostByTag($name){
        return $this->postRepository->searchPostByTag($name);
    }
}
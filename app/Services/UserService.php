<?php
namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getPostByUser()
    {
        $user_posts = $this->userRepository->getPostByUser();
        $posts = [];
        $tags = [];

        foreach ($user_posts as $item) {
            foreach ($item->posts as $post) {
                $tags = $post->tags->map(function ($tag) {
                    return [
                        'id' => $tag->id,
                        'name' => $tag->name,
                    ];
                });

                $posts[] = [
                    'id' => $post->id,
                    'title' => $post->title,
                    'slug' => $post->slug,
                    'content' => $post->content,
                    'published_at' => $post->published_at,
                    'tags' => $tags
                ];
            }
        }
        return $posts;
    }
}
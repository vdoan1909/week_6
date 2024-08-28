<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Services\PostService;
use App\Services\TagService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    protected $postService;
    protected $tagService;

    const PATH_VIEW = 'client.posts.';

    public function __construct(PostService $postService, TagService $tagService)
    {
        $this->postService = $postService;
        $this->tagService = $tagService;
    }

    public function create()
    {
        $this->authorize('create', Post::class);

        $tags = $this->tagService->getTagByUser();
        // dd($tags);

        return view(self::PATH_VIEW . __FUNCTION__, compact('tags'));
    }

    public function store(CreatePostRequest $request)
    {
        $this->authorize('create', Post::class);

        $data = $request->validated();
        // dd($data);

        $this->postService->create($data);

        return redirect()->route('client.home')->with('success', 'Post created successfully');
    }

    public function show($slug)
    {
        $post = $this->postService->getPostTagBySlug($slug);
        if (Gate::denies('view', $post)) {
            abort(403);
        }
        // dd($post);

        return view(self::PATH_VIEW . __FUNCTION__, compact('post'));
    }

    public function edit($slug)
    {
        $post = $this->postService->getPostTagBySlug($slug);
        // dd($post);
        $tags = $this->tagService->getTagByUser();


        if (Gate::denies('view', $post)) {
            abort(403);
        }

        return view(self::PATH_VIEW . __FUNCTION__, compact('post', 'tags'));
    }

    public function update(UpdatePostRequest $request, $slug)
    {
        $post = $this->postService->findBySlug($slug);

        $data = $request->validated();
        // dd($data);   

        $this->authorize('update', $post);
        $this->postService->updateBySlug($slug, $data);

        return redirect()->route('client.home')->with('success', 'Post updated successfully');
    }

    public function destroy($slug)
    {
        $post = $this->postService->findBySlug($slug);

        $this->authorize('delete', $post);

        $this->postService->deleteBySlug($slug);

        return redirect()->route('client.home')->with('success', 'Post deleted successfully');
    }

    public function searchPostByTitle(Request $request)
    {
        $title = $request->title ? $request->title : null;

        if ($title != null) {
            $data = $this->postService->searchPostByTitle($title);
        }

        return view('client.index', compact('data', 'title'));
    }

    public function searchPostByTag(Request $request)
    {
        $tag = $request->tag ? $request->tag : null;

        if ($tag != null) {
            $data = $this->postService->searchPostByTag($tag);
        }

        return view('client.index', compact('data'));
    }
}

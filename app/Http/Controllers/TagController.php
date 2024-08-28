<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;
use App\Services\TagService;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $tagService;

    const PATH_VIEW = 'client.tags.';

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function index()
    {
        $this->authorize('viewAny', Tag::class);
        $data = $this->tagService->getTagByUser();

        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    public function create()
    {
        $this->authorize('create', Tag::class);
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    public function store(CreateTagRequest $request)
    {
        // dd($request->all());

        $this->authorize('create', Tag::class);

        $data = $request->validated();
        // dd($data);

        $this->tagService->create($data);

        return redirect()->route('client.tag.index')->with('success', 'Create tag successfully');
    }

    public function edit($id)
    {
        $tag = $this->tagService->show($id);
        $this->authorize('view', $tag);

        return view(self::PATH_VIEW . __FUNCTION__, compact('tag'));
    }

    public function update(UpdateTagRequest $request, $id)
    {
        $tag = $this->tagService->show($id);
        $this->authorize('view', $tag);

        $data = $request->validated();

        $this->tagService->update($id, $data);

        return redirect()->route('client.tag.index')->with('success', 'Update tag successfully');
    }

    public function destroy($id)
    {
        $tag = $this->tagService->show($id);
        $this->authorize('view', $tag);

        $this->tagService->delete($id);

        return redirect()->route('client.tag.index')->with('success', 'Delete tag successfully');
    }
}

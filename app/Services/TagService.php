<?php
namespace App\Services;

use App\Repositories\TagRepository;
use Illuminate\Support\Facades\Auth;

class TagService
{
    protected $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function getTagByUser()
    {
        return $this->tagRepository->getTagByUser();
    }

    public function create(array $data)
    {
        $data = [
            'name' => $data['name'],
            'user_id' => $data['user_id']
        ];

        return $this->tagRepository->create($data);
    }

    public function show($id)
    {
        return $this->tagRepository->find($id);
    }

    public function update($id, array $data)
    {
        $tag = $this->tagRepository->find($id);

        $data = [
            'name' => $data['name'],
            'user_id' => $data['user_id']
        ];

        if ($tag) {
            $tag->update($data);
            return $tag;
        }
    }

    public function delete($id)
    {
        $tag = $this->tagRepository->find($id);
        if ($tag) {
            $tag->delete();
            return true;
        }
    }
}
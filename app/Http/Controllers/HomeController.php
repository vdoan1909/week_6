<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\UserService;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        if (Gate::denies('viewAny', Post::class)) {
            abort(403);
        }

        $data = $this->userService->getPostByUser();
        // dd($data);

        return view('client.index', compact('data'));
    }
}

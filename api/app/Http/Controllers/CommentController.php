<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function  __construct(
        private readonly CommentService $service
    ) {
    }

    public function index(Request $request)
    {
        $hasPostId = $request->has('post_id');
        $data['items'] = $hasPostId ? $this->service->all($request->post_id) : [];
        return $data;
    }

    public function store(StoreCommentRequest $request)
    {
        $data['item'] = $this->service->create($request);
        return $this->respond($data);
    }

    public function delete($id)
    {
        $data['deleted'] = $this->service->delete($id);
        return $this->respond($data);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Services\PostService;
use App\Models\Post;

class PostController extends Controller
{
    public function  __construct(
        private readonly PostService $service
    ) {
        // $this->middleware('auth:api');
        $this->middleware('auth:api', ['except'=>'index']);
    }
    public function index()
    {
        $data['items'] = $this->service->all();
        return $this->respond($data);
    }

    public function store(StorePostRequest $request)
    {
        $data['item'] = $this->service->create($request);
        return $this->respond($data);
    }

    public function update(string $id, UpdatePostRequest $request)
    {
        $data['updated'] = $this->service->update($id, $request);
        return $this->respond($data);
    }

    public function delete(string $id)
    {
        $data['deleted'] = $this->service->delete($id);
        return $this->respond($data);
    }
}

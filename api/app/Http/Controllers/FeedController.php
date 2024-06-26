<?php

namespace App\Http\Controllers;

use App\Http\Services\FeedService;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    //
    public function __construct(
        private readonly FeedService $service
    ) {

        $this->middleware('auth:api', ['except' => 'index']);
    }


    public function index(Request $request)
    {
        $data = $this->service->posts($request->get('per_page', 12));
        return $this->respond($data);
    }

    public function popular(Request $request)
    {
        $data = $this->service->popular(auth()->id(), $request->get('per_page', 12));
        return $this->respond($data);
    }

    public function new(Request $request)
    {
        $data = $this->service->new(auth()->id(), $request->get('per_page', 12));
        return $this->respond($data);
    }

    public function friends(Request $request)
    {
        $data = $this->service->friends(auth()->id(), $request->get('per_page', 12));
        return $this->respond($data);
    }
}

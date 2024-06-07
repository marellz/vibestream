<?php

namespace App\Http\Services;

use App\Models\User as Model;
use App\Http\Requests\User\UpdateUserRequest as UpdateModelRequest;
use App\Http\Requests\User\StoreUserRequest as StoreModelRequest;

use Illuminate\Database\Eloquent\Collection;

class TestService
{
    public function all(): Collection
    {
        return Model::all();
    }

    public function get(string $id): Model
    {
        return Model::findOrFail($id);
    }

    public function create(StoreModelRequest $request): Model
    {
        return Model::create(
            $request->safe()->only([
               ''
            ])
        );
    }
    public function update(string $id, UpdateModelRequest $request): bool
    {
        $Model = $this->get($id);
        return $Model->update(
            $request->safe()->only([
               ''
            ])
        );
    }

    public function delete(string $id): bool
    {
        $Model = $this->get($id);
        return $Model->delete();
    }
}

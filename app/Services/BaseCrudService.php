<?php

namespace App\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

abstract class BaseCrudService
{
    /** @var class-string<Model> */
    protected string $model;

    /** @var array<int, string> */
    protected array $with = [];

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model::query()->with($this->with)->latest()->paginate($perPage);
    }

    public function find(int $id): Model
    {
        return $this->model::with($this->with)->findOrFail($id);
    }

    public function create(array $data): Model
    {
        $record = $this->model::create($data);

        return $record->fresh($this->with);
    }

    public function update(Model $record, array $data): Model
    {
        $record->update($data);

        return $record->fresh($this->with);
    }

    public function delete(Model $record): void
    {
        $record->delete();
    }
}

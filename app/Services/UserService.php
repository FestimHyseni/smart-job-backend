<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserService extends BaseCrudService
{
    protected string $model = User::class;

    public function update(Model $record, array $data): Model
    {
        if (array_key_exists('password', $data) && empty($data['password'])) {
            unset($data['password']);
        }

        return parent::update($record, $data);
    }
}

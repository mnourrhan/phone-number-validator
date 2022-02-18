<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function all();

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function get($id = null);

    public function first();

    public function where(...$params);

    public function paginate($perPage);

    public function find($id);

    public function query();
}

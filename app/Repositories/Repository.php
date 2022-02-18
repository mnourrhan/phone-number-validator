<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Retrieve all data of repository
     * @return \Illuminate\Database\Eloquent\Collection|Model[]
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Save a new entity in repository
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update a entity in repository by id
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, $id)
    {
        $record = $this->find($id);
        return $record->update($data);
    }

    /**
     * Delete model by id
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->model->find($id)->delete($id);
    }

    /**
     * Get a single item or collection
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection
     */
    public function get($id = null)
    {
        if (!is_null($id)) {
            return $this->find($id);
        }
        return $this->model->get();
    }

    /**
     * Returns the first row of the selected resource
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function first()
    {
        return $this->model->first();
    }

    /**
     * Adds a chainable where statement
     * @param array|mixed $params
     * @return $this self
     */
    public function where(...$params)
    {
        $this->model = $this->model->where(...$params);
        return $this;
    }
    /**
     * Get paginated collection
     * @param int $perPage
     * @return Collection
     */
    public function paginate($perPage)
    {
        return $this->model->paginate($perPage);
    }

    /**
     * Alias of model find
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($id)
    {
        return $this->model->find($id);
    }


    /**
     * Get model query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(){
        $this->model = $this->model->query();
        return $this->model;
    }
}

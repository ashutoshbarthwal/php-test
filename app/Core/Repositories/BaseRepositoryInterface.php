<?php namespace App\Core\Repositories;

interface BaseRepositoryInterface
{
    public function errors();

    public function all(array $related = null);

    public function get($id, array $related = null);

    public function paginate($perPage = 15);

    public function getRecent($limit, array $related = null);

    public function create(array $data);

    public function update($model, array $data);

    public function delete($id);

    public function deleteWhere($column, $value);
}

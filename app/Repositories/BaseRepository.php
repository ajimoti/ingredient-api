<?php

namespace App\Repositories;

use App\Traits\Pagination;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Interfaces\BaseInterface;

class BaseRepository implements BaseInterface
{

    use Pagination;

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all() : Object
    {
        return $this->model->all();
    }

    public function paginate(int $perPage = 10) : Object
    {
        $tableName = $this->model->getTable();
        $paginated = $this->model->paginate($perPage);

        return $this->customPagination($tableName, $paginated);
    }

    public function delete(int $id) : Object
    {
        return $this->model->destroy($id);
    }

    public function show(int $id) : Object
    {
        return $this->model->findOrFail($id);
    }

    public function getModel() : Object
    {
        return $this->model;
    }

    public function with($relations) : Object
    {
        return $this->model->with($relations);
    }
}

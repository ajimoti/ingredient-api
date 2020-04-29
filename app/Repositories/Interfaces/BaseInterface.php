<?php

namespace App\Repositories\Interfaces;

interface BaseInterface
{
    public function all();

    public function paginate();

    public function delete(int $id);

    public function show(int $id);

    public function getModel();

    public function with(any $relations);
}

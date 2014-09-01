<?php

namespace Metin\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;

class AbstractRepository {

	protected $model;

	public function __construct(Model $model)
	{
		$this->model = $model;
	}

	public function getNew(array $args = array())
	{
		return $this->model->newInstance($args);
	}

    public function toArray($data)
    {
        if (false != $data)
        {
            return $data->toArray();
        }

        return false;
    }
}
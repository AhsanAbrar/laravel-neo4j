<?php

namespace Ahsan\Neo4j;

class Cypher
{
	use Concerns\Connection,
		Concerns\Create;

	/**
	 * Current Model
	 */
	protected $model;

	/**
	 * neo4j query
	 */
	public function query($queryString, $param = [])
	{
		return $this->client->run($queryString, $param);
	}

	public function first($result)
	{
		$class = 'App\\' . $this->table;

		$attributes = $result->getRecord()->values()[0]->values();
		$attributes['identity'] = $result->getRecord()->values()[0]->identity();

		return $this->model = (new $class())->newFromBuilder($attributes);
	}

	public function get()
	{
		$models = [];

		if (count($this->resultSet) == 0)
			return Collection::make($models);

		foreach ($this->resultSet as $row) {
			$attributes = $row['t']->getProperties();
			$model = $this->model->newFromBuilder($attributes);
			$models[] = $model;
		}

		return Collection::make($models);
	}
}

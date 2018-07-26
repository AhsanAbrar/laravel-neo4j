<?php

namespace Ahsan\Neo4j;

abstract class Cypher
{
	use Concerns\Connection;

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

	public function first()
	{
		if (count($this->resultSet) == 0)
			return null;

		foreach ($this->resultSet as $row) {
			$attributes = $row['t']->getProperties();
			$model = $this->model->newFromBuilder($attributes);

			return $model;
		}
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

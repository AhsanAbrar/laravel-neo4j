<?php

namespace Ahsan\Neo4j;

use Illuminate\Database\Eloquent\Collection;

class Cypher
{
	use Concerns\Connection,
		Concerns\Create,
		Concerns\Relation;

	/**
	 * Current Model
	 */
	protected $model;

	/**
	 * The Neo4j Current Node Label
	 */
	protected $table;

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
		$attributes['id'] = $result->getRecord()->values()[0]->identity();

		return $this->model = (new $class())->newFromBuilder($attributes);
	}

	public function get($result)
	{
		$class = 'App\\' . $this->table;
		$models = [];

		if (!$result->getRecords())
			return Collection::make($models);

		foreach ($result->getRecords() as $record) {
			$attributes = $record->values()[0]->values();
			$attributes['id'] = $record->values()[0]->identity();

			$models[] = $this->model = (new $class())->newFromBuilder($attributes);
		}

		return Collection::make($models);
	}
}

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
	 * The Neo4j query string
	 */
	protected $queryString;

	/**
	 * The Neo4j query parameters
	 */
	protected $queryParam;

	/**
	 * The Graphaware ResultSet
	 */
	protected $result;

	/**
	 * neo4j query
	 */
	public function query($queryString, $param = [])
	{
		return $this->client->run($queryString, $param);
	}

	/**
	 * neo4j query
	 */
	public function rawQuery($model, $queryString, $param = [])
	{
		$model = 'App\\' . $model;
		$this->model = new $model();

		$this->queryString = $queryString;
		$this->queryParam = $param;

		return $this;
	}

	public function rawFirst()
	{
		$result = $this->query($this->queryString, $this->queryParam);

		$attributes = $result->getRecord()->values()[0]->values();
		$attributes['id'] = $result->getRecord()->values()[0]->identity();

		return $this->model->newFromBuilder($attributes);
	}

	public function rawGet()
	{
		$result = $this->query($this->queryString, $this->queryParam);

		$models = [];

		if (!$result->getRecords())
			return Collection::make($models);

		foreach ($result->getRecords() as $record) {
			$attributes = $record->values()[0]->values();
			$attributes['id'] = $record->values()[0]->identity();

			$models[] = $this->model->newFromBuilder($attributes);
		}

		return Collection::make($models);
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

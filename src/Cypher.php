<?php

namespace Ahsan\Neo4j;

use GraphAware\Neo4j\Client\ClientBuilder;
use Illuminate\Config\Repository as Config;

abstract class Cypher
{
	/**
	 * The Neo4j Graphaware Client
	 */
	protected $client;

	/**
	 * Configurations
	 */
	protected $config;

	/**
	 * Current Model
	 */
	protected $model;

	/**
	 * Constructor()
	 */
	function __construct(Config $config)
	{
		$this->config = $config;

		$this->setClient();
	}

	/**
	 * Set Client First
	 */
	public function setClient()
	{
		$this->client = ClientBuilder::create()
			->addConnection($this->config->get('app.name'), 'http://neo4j:root@localhost:7474')
			//->addConnection('bolt', 'bolt://neo4j:root@localhost:7687')
			->build();
	}

	/**
	 * neo4j query
	 */
	public function query($queryString)
	{
		return $this->client->run($queryString);
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

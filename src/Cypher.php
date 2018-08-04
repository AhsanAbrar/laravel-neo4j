<?php

namespace Ahsan\Neo4j;

class Cypher
{
	use Concerns\Connection;

	/**
	 * neo4j run query
	 *
	 * @return Result
	 */
	public function run($queryString, $param = [])
	{
		return $this->client->run($queryString, $param);
	}
}

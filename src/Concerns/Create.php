<?php

namespace Ahsan\Neo4j\Concerns;

use Carbon\Carbon;

trait Create
{
	/**
	 * The Neo4j Current Node Label
	 */
	protected $table;

	/**
	 * Create single item
	 */
	public function create($table, $attributes)
	{
		$this->table = $table;

		$result = $this->query($this->createStatement(), [
			'data' => array_merge($attributes, $this->getTimestamps())
		]);

		return $this->first($result);
	}

	/**
	 * Create single item
	 */
	public function createStatement()
	{
		return 'CREATE (n:' . $this->table . ') SET n += {data} return n';
	}

	/**
	 * Create single item
	 */
	public function getTimestamps()
	{
		return ['created_at' => Carbon::now()->toDateTimeString(), 'updated_at' => Carbon::now()->toDateTimeString()];
	}
}

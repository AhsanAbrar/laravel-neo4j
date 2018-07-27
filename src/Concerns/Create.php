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
			'props' => array_merge($attributes, $this->getTimestamps())
		]);

		return $this->first($result);
	}

	/**
	 * Create single item
	 */
	public function createStatement()
	{
		return 'CREATE (n:' . $this->table . ') SET n += {props} return n';
	}

	/**
	 * Insert Multiple Items
	 */
	public function insert($table, $attributes)
	{
		$this->table = $table;

		$records = [];

		foreach ($attributes as $row) {
			$records[] = array_merge($row, $this->getTimestamps());
		}

		$result = $this->query($this->insertStatement(), [
			'props' => $records
		]);

		return true;
	}

	/**
	 * Create single item
	 */
	public function insertStatement()
	{
		return 'UNWIND {props} as map
CREATE (n:' . $this->table . ')
SET n = map';

		return 'CREATE (n:' . $this->table . ') SET n += {props} return n';
	}

	/**
	 * Create single item
	 */
	public function getTimestamps()
	{
		return ['created_at' => Carbon::now()->toDateTimeString(), 'updated_at' => Carbon::now()->toDateTimeString()];
	}
}

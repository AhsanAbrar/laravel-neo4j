<?php

namespace Ahsan\Neo4j\Concerns;

use Carbon\Carbon;

trait Relation
{
	/**
	 * BelongsTo Relation
	 */
	public function belongsTo($table, $relation, $to)
	{
		$this->table = $table;

		$result = $this->query($this->belongsToStatement($relation, $to));

		return $this->get($result);
	}

	/**
	 * Create single item
	 */
	public function belongsToStatement($relation, $to)
	{
		return 'MATCH (t:' . $to . ')-[r:' . $relation . ']->(n:' . $this->table . ') RETURN n LIMIT 25';
	}
}

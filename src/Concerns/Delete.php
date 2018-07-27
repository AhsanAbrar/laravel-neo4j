<?php

namespace Ahsan\Neo4j\Concerns;

use Carbon\Carbon;

trait Delete
{
	/**
	 * Create single item
	 */
	public function delete($table, $identity)
	{
		$this->table = $table;

		$result = $this->query($this->deleteStatement($identity));

		return true;
	}

	/**
	 * Create single item
	 */
	public function deleteStatement($identity)
	{
		return 'MATCH (n:' . $this->table . ') WHERE ID(n) = ' . $identity . 'DELETE n';
	}
}

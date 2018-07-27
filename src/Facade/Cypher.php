<?php

namespace Ahsan\Neo4j\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ahsan\Neo4j\Schema\Builder
 */
class Cypher extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'cypher';
    }

}

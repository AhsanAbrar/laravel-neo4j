# Laravel-Neo4j
Laravel wrapper for Neo4j graph database.

## Installation
```
composer require AhsanAbrar/laravel-neo4j
```

## Configuration

create config/cypher.php file

```
<?php

return [
    'ssl' => false,
    'connection' => 'default',
    'host'   => env('DB_HOST', 'localhost'),
    'port'   => env('DB_PORT', '7474'),
    'username' => env('DB_USERNAME', 'neo4j'),
    'password' => env('DB_PASSWORD', 'neo4j')
];
```

## Run Cypher Query

```
use Ahsan\Neo4j\Facade\Cypher;

Cypher::run("MATCH (n) RETURN n");
```

return Graphaware results

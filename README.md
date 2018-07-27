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

## Create Record

```
Cypher::create('User', ['name' => 'Ahsan']);
```

return current created instance with model

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

## Insert Multiple Records

```
Cypher::insert('User', [
    [
        'name' => 'Ahsan'
    ],
    [
        'name' => 'Abrar'
    ]
]);
```

return true when successful.

## Delete Single Node with Identity

```
Cypher::delete('User', 1209);
```

return true when successful.

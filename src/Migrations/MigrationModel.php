<?php namespace Ahsan\Neo4j\Migrations;

use Ahsan\Neo4j\Eloquent\Model as NeoEloquent;

class MigrationModel extends NeoEloquent {

    /**
     * {@inheritDoc}
     */
    protected $label = 'NeoEloquentMigration';

    /**
     * {@inheritDoc}
     */
    protected $fillable = array(
        'migration',
        'batch'
    );

    /**
     * {@inheritDoc}
     */
    protected $guarded = array();

}

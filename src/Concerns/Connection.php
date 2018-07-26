<?php

namespace Ahsan\Neo4j\Concerns;

use GraphAware\Neo4j\Client\ClientBuilder;

trait Connection
{
    /**
     * The Neo4j Graphaware Client
     */
    protected $client;

    /**
     * Constructor()
     */
    function __construct()
    {
        $this->setClient();
    }

    /**
     * Set Client First
     */
    public function setClient()
    {
        $this->client = ClientBuilder::create()
            ->addConnection(config('cypher.connection'), $this->getClientUrl())
            ->build();
    }

    /**
     * get client url
     */
    public function getClientUrl()
    {
        return $this->getProtocol() . config('cypher.username') . ':' . config('cypher.password') . '@' . config('cypher.host') . ':' . config('cypher.port');
    }

    /**
     * Get the url protocol
     *
     * @return string
     */
    public function getProtocol()
    {
        if (config('cypher.connection') == 'bolt')
            return 'bolt://';

        return config('cypher.ssl') ? 'https://' : 'http://';
    }
}

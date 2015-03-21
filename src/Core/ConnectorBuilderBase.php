<?php

namespace Lia\Bridge\DhtmlxBundle\Core;

abstract class ConnectorBuilderBase
    extends BuilderBase
{
    /**
     * @var \Connector
     */
    protected $connector;

    /**
     * Get the name of Class who make the connector
     * @return string
     */
    abstract protected function getNameOfConnector();

    /**
     * Get The connector instance
     * @return \Connector
     */
    public function getConnector()
    {
        if (!$this->connector) {
            $this->load(['db_pdo']);
            $nameOfConnector = $this->getNameOfConnector();
            $this->connector = new $nameOfConnector(
                $this->container->get('database_connection')->getWrappedConnection(),
                "PDO"
            );
        }
        return $this->connector;
    }
}
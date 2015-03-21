<?php

namespace Lia\Bridge\DhtmlxBundle\Grid;

class ConnectorBuilder
    extends ConnectorBuilderBag
{
    /**
     * It's used for init the configuration of the builder
     * @var array
     */
    protected $itemsConfiguration = [
        /**
         * @var string
         */
        'sqlId' => 'id',

        /**
         * @var string
         */
        'sqlTable' => '',

        /**
         * @var string
         */
        'ajaxSourceType' => 'xml',

        /**
         * @var bool
         */
        'dataProcessorEnabled'=> false,

        /**
         * List of Fields for the query
         * @var []
         */
        'sqlFields' => [],

        /**
         * List of Extra Fields for the query
         * @var []
         */
        'sqlExtraFields' => [],
    ];

    /**
     * @var \GridConfiguration
     */
    private $configurator;


    public function __construct()
    {
        parent::__construct($this->itemsConfiguration);
    }

    /**
     * Get Dhtmlx (PHP) Libraries to load
     * Note : The connector must use a PDO Instance.The library for it is loaded automatically
     * @return array
     */
    protected function getLibrariesToLoad()
    {
        return ['grid_config', 'grid_connector'];
    }

    /**
     * Get the name of Class who make the connector
     * @return string
     */
    protected function getNameOfConnector()
    {
        return '\GridConnector';
    }

    /**
     * Get The DhtmlX Grid Configuration instance
     * @return \GridConfiguration
     */
    public function getConfigurator()
        // TODO : Maybe to move in BaseConnectorBuilder with generic treatment
    {
        if (!$this->configurator) {
            $this->configurator = new \GridConfiguration();
        }
        return $this->configurator;
    }

    /**
     * Get The DhtmlX Grid Connector instance
     * @return \GridConnector
     */
    public function getConnector()
    {
        if (!$this->connector) {
            /**
             * @var \GridConnector $connector
             */
            $connector = parent::getConnector();
            $connector->set_config($this->getConfigurator());
        }
        return $this->connector;
    }

    /**
     * @return string
     * @throws ConnectorBuilderException
     */
    public function renderTable()
    {

        if(!$tableName = $this->getSqlTable()) {
            throw new ConnectorBuilderException('The name of table must not be empty !');
        }

        if(!$tableId = $this->getSqlId()) {
            throw new ConnectorBuilderException('The id of table must not be empty !');
        }

        /*
         * NOTE : the render_table() normally do an echo by the output method
         * (called in output_as_xml method).
         *
         * I fixed it by cascading return in the vendor library so be care full
         * if the vendor library is changed !
         *
         * Another change : a die() method was deleted because she stop the treatment
         * and it was not a good idea. Again be care full for the same reason of top !
         */
        return $this->getConnector()->render_table(
            $tableName,
            $tableId,
            $this->getSqlFields(true),
            $this->getSqlExtraFields(true)
        );
    }
}
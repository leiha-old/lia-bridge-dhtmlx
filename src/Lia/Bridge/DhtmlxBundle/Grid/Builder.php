<?php

namespace Lia\Bridge\DhtmlxBundle\Grid;

use Lia\KernelBundle\Bag\CollectionBag;
use Symfony\Component\HttpFoundation\Response;

class Builder
    extends BuilderBag
    implements BuilderInterface
{
    /**
     * It's used for init the configuration of the builder bag
     * @var array
     */
    protected $itemsConfiguration = [
        /**
         * Name of the grid. Used for to generate the front code (Js + Html)
         * @var string
         */
        'name' => '',

        /**
         * Route used for get the data by ajax and if enabled for the dhtmlx data processor
         * @var string
         */
        'ajaxSource' => '',

        /**
         * @var string
         */
        'ajaxSourceType' => 'xml',

        /**
         * @var bool
         */
        'dataProcessorEnabled'=> false,

        /**
         * List of Columns for the grid
         * @var CollectionBag
         */
        'columns' => null,
    ];

    /**
     * Mapping for the methods
     * @var array[]
     */
    protected $columnMethods = [
        //Column         Dhtmlx JS     |  Dhtmlx PHP
        'getLabel'  => ['setHeader'    , 'setHeader'    ],
        'getId'     => ['setColumnIds' , 'setColIds'    ],
        'getWidth'  => ['setInitWidths', 'setInitWidths'],
        'getAlign'  => ['setColAlign'  , 'setColAlign'  ],
        'getType'   => ['setColTypes'  , 'setColTypes'  ],
        'getSorting'=> ['setColSorting', 'setColSorting'],
        'getColor'  => ['setColColor'  , 'setColColor'  ],
        'getVAlign' => ['setColVAlign' , 'setColVAlign' ],
    ];

    /**
     * Type of rendering
     * @var string
     */
    protected $renderingType = 'lia';

    /**
     * Define the objects available for the render
     * @var array
     */
    protected $renderingTypeAvailable = [
        'lia'    => 'Lia\Bridge\DhtmlxBundle\Grid\BuilderRendererWithLia',
        'dhtmlx' => 'Lia\Bridge\DhtmlxBundle\Grid\BuilderRendererWithDhtmlx',
    ];

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var ConnectorBuilder
     */
    private $connector;

    /**
     * @var ConfiguratorInterface
     */
    private $configurator;

    /**
     * @param ConfiguratorInterface $configurator
     * @throws BuilderException
     */
    public function __construct(ConfiguratorInterface $configurator)
    {
        $name = $configurator->getName();
        if(!$name) {
            throw new BuilderException('The name of the grid is not be empty');
        }
        $this->itemsConfiguration['name'] = $name;
        parent::__construct($this->itemsConfiguration);
        $this->configurator = $configurator;
    }

    /**
     * We must override this parent hook
     *  because we need container initialized
     *   before to configure the builder with configurator
     */
    protected function __onAfterSetContainer()
    {
        parent::__onAfterSetContainer();
        $this->configurator->setGridConfiguration($this);
    }

    /**
     * Get Dhtmlx (PHP) Libraries to load
     * <br /> Note : The connector must use PDO Instance.
     * The library for it is loaded automatically
     * @return array
     */
    protected function getLibrariesToLoad()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function setData(array $data = [])
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return array
     */
    public function getData(){
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function render()
    {
        /* @var $renderer BuilderRenderer */
        $renderer = $this->renderingTypeAvailable[$this->renderingType];
        $renderer = new $renderer($this);
        return $renderer->render();
    }

    /**
     * @return ConnectorBuilder
     */
    public function getConnector()
    {   if (!$this->connector) {
            $this->connector = $this->container->get('lia.factory.dhtmlx.grid')
                ->getConnectorBuilder();

            $this->addConfigToConnector();
        }
        return $this->connector;
    }

    /**
     * It used when you ask for Connector in back side
     * <br /> Allows to configure the connector with the grid configuration
     * @return void
     */
    protected function addConfigToConnector()
    {
        $connector = $this->getConnector();
        $this->configurator->setSourceDataConfiguration($connector);

        $columns = $this->columns->iterate(
            function(Column $column){
                return $column->getId();
            }
            , 'array[]'
        );
        $connector->setSqlFields($columns);

        $configurator = $connector->getConfigurator();
        $this->iterateOnMethodsOfColumns(
            function ($dhtmlxMethod, $concat) use ($configurator) {
                $configurator->$dhtmlxMethod[1]($concat);
            }
        );
    }

    /**
     * @param Callable $callback
     * @return void
     */
    public function iterateOnMethodsOfColumns(Callable $callback)
    {
        foreach ($this->columnMethods as $liaMethod => $dhtmlxMethod) {
            $concat = $this->columns->iterate(
                function(Column $column) use($liaMethod){
                    return $column->$liaMethod();
                }
                , 'array[]'
            );

            if (count($concat)) {
                $callback($dhtmlxMethod, implode(',', $concat));
            }
        }
    }

    /**
     * Allows to render the response of connector for send the data by ajax for example
     * @param string $type Available : [xml]
     * @param bool $enableSymfonyResponse Integrates the output with Response Object
     * @return string
     * @throws BuilderException
     */
    public function renderConnector($type = 'xml', $enableSymfonyResponse = true){
        $typesAvailable = [
            // TODO : Make a different formats for output (json in more by example)
            // TODO : Maybe to pass the array of types on property
            'xml' => 'text/xml'
        ];

        $response = $this->getConnector()->renderTable();
        if($enableSymfonyResponse){
            if(!isset($typesAvailable[$type])) {
                throw new BuilderException(
                    '[ [:type] ] is not present in the available types of output format :'
                    .' [ [:implode: | :available] ]'
                    ,
                    ['type' => $type, 'available' => $typesAvailable]
                );
            }
            $response = new Response($response);
            $response->headers->set('Content-Type', $typesAvailable[$type]);
        }
        return $response;
    }


}
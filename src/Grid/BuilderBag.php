<?php

namespace Lia\Bridge\DhtmlxBundle\Grid;

use Lia\Bridge\DhtmlxBundle\Core\BuilderBase;
use Lia\KernelBundle\Bag\CollectionBag;

abstract class BuilderBag
    extends BuilderBase
    implements BuilderBagInterface
{
    /**
     * @var Column[]
     */
    protected $columns;

    public function __construct(array $items = [])
    {
        parent::__construct($items);
        $this->columns = $this->add('columns', new CollectionBag(), true);
    }

    /**
     * Get the name of the grid
     * @return string
     */
    public function getName()
    {
        return $this->get('name');
    }

    /**
     * Get the ajax Source
     * @return string
     */
    public function getAjaxSource()
    {
        return $this->get('ajaxSource');
    }

    /**
     * Set the url of data source
     * @param string $ajaxSource Name Of Route used for get the data
     * @param bool $enableDataProcessor
     * @return BuilderBag
     */
    public function setAjaxSource($ajaxSource, $enableDataProcessor = false)
    {
        $this->enableDataProcessor($enableDataProcessor);
        return $this->add('ajaxSource', $this->container->get('router')->generate($ajaxSource));
    }

    /**
     * Check if Data Processor is enabled
     * @return bool
     */
    public function isDataProcessorEnabled()
    {
        return $this->get('dataProcessorEnabled');
    }

    /**
     * @param bool $enableDataProcessor
     * @return BuilderBag
     */
    public function enableDataProcessor($enableDataProcessor)
    {
        return $this->add('dataProcessorEnabled', (bool)$enableDataProcessor);
    }

    /**
     * Get the column with the label
     * @param string $label
     * @return Column|null
     */
    public function getColumn($label)
    {
        return $this->columns->get($label);
    }

    /**
     * Allows to add a column in the grid
     * @param string $label String who will be on the header of the column
     * @param string $id Mapped Key in the data (for array or sql)
     * @return Column
     */
    public function addColumn($label, $id)
    {
        return $this->columns->add($label, new Column($label, $id), true);
    }

    /**
     * Set the format of the source of data
     * Note : By default the source is typed on xml.
     * @param string $type
     * @return BuilderBag
     * @throws BuilderException
     */
    public function setAjaxSourceType($type)
    {
        // TODO : Completes the types
        // TODO : Maybe to pass the array of types on property
        $typesAvailable = ['xml', 'json'];
        if(!in_array($type, $typesAvailable)) {
            throw new BuilderException(
                '[ [:type] ] is not present in the available types of source :'
                .' [ [:implode: | :available] ]'
                ,
                ['type' => $type, 'available' => $typesAvailable]
            );
        }
        return $this->add('ajaxSourceType', $type);
    }
}
<?php

namespace Lia\Bridge\DhtmlxBundle\Grid;

use Lia\KernelBundle\Service\ServiceBase;
use Lia\Bridge\DhtmlxBundle\Grid\Builder as GridBuilder;
use Lia\Bridge\DhtmlxBundle\Grid\ConnectorBuilder as GridConnectorBuilder;
use Lia\Bridge\DhtmlxBundle\Grid\ConfiguratorInterface as GridConfiguratorInterface;

class FactoryService
    extends ServiceBase
{
    /**
     * Get an instance of Dhtmlx Grid Component
     * @param GridConfiguratorInterface $configurator
     * @return GridBuilder
     */
    public function getBuilder(GridConfiguratorInterface $configurator)
    {
        $builder = new GridBuilder($configurator);
        $builder->setContainer($this->container);
        return $builder;
    }

    /**
     * Get an instance of Dhtmlx Grid Connector Component
     * @return GridConnectorBuilder
     */
    public function getConnectorBuilder()
    {
        $builder = new GridConnectorBuilder();
        $builder->setContainer($this->container);
        return $builder;
    }
}
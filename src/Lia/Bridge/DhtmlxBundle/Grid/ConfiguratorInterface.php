<?php

namespace Lia\Bridge\DhtmlxBundle\Grid;

interface ConfiguratorInterface
{
    /**
     * Set the Name Of the Component
     * @return string
     */
    public function getName();


    /**
     * Allows to configure the Grid Component (for front side)
     * @param BuilderBagInterface $bag
     * @return void
     */
    public function setGridConfiguration(BuilderBagInterface $bag);


    /**
     * Allows to configure the Grid Connector Component (for back side)
     * <br /> Note : The required fields for the grid are automatically loaded
     * @param ConnectorBuilderBagInterface $bag
     * @return void
     */
    public function setSourceDataConfiguration(ConnectorBuilderBagInterface $bag);
}
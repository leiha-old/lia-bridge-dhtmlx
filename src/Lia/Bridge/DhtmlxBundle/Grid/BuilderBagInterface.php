<?php

namespace Lia\Bridge\DhtmlxBundle\Grid;

interface BuilderBagInterface
{
    /**
     * Allows to add a column in the grid
     * @param string $label String who will be on the header of the column
     * @param string $id Mapped Key in the data (for array or sql)
     * @return ColumnBagInterface
     */
    public function addColumn($label, $id);

    /**
     * Set the url of data source
     * @param string $ajaxSource Name Of Route used for get the data
     * @param bool $enableDataProcessor
     * @return BuilderBagInterface
     */
    public function setAjaxSource($ajaxSource, $enableDataProcessor = false);

    /**
     * Set the format of the source of data
     * Note : By default the source is typed on xml.
     * @param string $type
     * @return BuilderBagInterface
     */
    public function setAjaxSourceType($type);

    /**
     * @param bool $enableDataProcessor
     * @return BuilderBagInterface
     */
    public function enableDataProcessor($enableDataProcessor);
}
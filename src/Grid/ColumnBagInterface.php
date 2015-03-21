<?php

namespace Lia\Bridge\DhtmlxBundle\Grid;

interface ColumnBagInterface
{
    /**
     * @param int $initWidth
     * @return ColumnBagInterface
     */
    public function setWidth($initWidth);

    /**
     * @param string $colAlign
     * @return ColumnBagInterface
     */
    public function setAlign($colAlign);

    /**
     * @param string $colVAlign
     * @return ColumnBagInterface
     */
    public function setVAlign($colVAlign);

    /**
     * @param string $colColor
     * @return ColumnBagInterface
     */
    public function setColor($colColor);

    /**
     * @param string $colType
     * @return ColumnBagInterface
     * @throws ColumnException
     * @link http://docs.dhtmlx.com/grid__columns_types.html
     */
    public function setType($colType);

    /**
     * @param string $colSorting Available : [int | date | str | na]
     * @return ColumnBagInterface
     * @throws ColumnException
     */
    public function setSorting($colSorting);
}
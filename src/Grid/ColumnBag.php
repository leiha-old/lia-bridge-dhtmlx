<?php

namespace Lia\Bridge\DhtmlxBundle\Grid;

use Lia\KernelBundle\Bag\CollectionBag;

class ColumnBag
    extends CollectionBag
    implements ColumnBagInterface
{
    /**
     * For More Information see the link of documentation
     * @link http://docs.dhtmlx.com/grid__columns_types.html
     * @var array
     */
    private $typesAvailable = [
        'ed'   , 'edtxt' , 'edn',
        'ro'   , 'rotxt' , 'ron',
        'int'  , 'date'  , 'str',
        'na'   , 'txt'   , 'txttxt',
        'ra'   , 'ra_str', 'ch',
        'co'   , 'coro'  , 'combo',
        'clist', 'combo' , 'clist',
        'cp'   , 'link'  , 'img',
        'price', 'dyn'   , 'calck',
        'stree', 'grid'  ,
        'dhxCalendar'    , 'dhxCalendarA',
    ];

    /**
     * @var array
     */
    private $sortingAvailable = [
        'int', 'date', 'str', 'na'
    ];

    /**
     * @param int $initWidth
     * @return Column
     */
    public function setWidth($initWidth)
    {
        return $this->add('width', $initWidth);
    }

    /**
     * @param string $colAlign
     * @return Column
     */
    public function setAlign($colAlign)
    {
        return $this->add('align', $colAlign);
    }

    /**
     * @param string $colVAlign
     * @return Column
     */
    public function setVAlign($colVAlign)
    {
        return $this->add('vAlign', $colVAlign);
    }

    /**
     * @param string $colColor
     * @return Column
     */
    public function setColor($colColor)
    {
        return $this->add('color', $colColor);
    }

    /**
     * @param string $colType
     * @return Column
     * @throws ColumnException
     * @link http://docs.dhtmlx.com/grid__columns_types.html
     */
    public function setType($colType)
    {
        if(!in_array($colType, $this->typesAvailable)){
            throw new ColumnException(
                '[ [:type] ] is not present in the available types :'
                    .' [ [:implode: | :available] ]'
                ,
                ['type' => $colType, 'available' => $this->typesAvailable]
            );
        }
        return $this->add('type', $colType);
    }

    /**
     * @param string $colSorting Available : [int | date | str | na]
     * @return Column
     * @throws ColumnException
     */
    public function setSorting($colSorting)
    {
        if(!in_array($colSorting, $this->sortingAvailable)){
            throw new ColumnException(
                '[[:sorting]] is not present in the available types of sorting :'
                    .' [ [:implode: | :available] ]'
                ,
                ['sorting' => $colSorting, 'available' => $this->sortingAvailable]
            );
        }
        return $this->add('sorting', $colSorting);
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->get('id');
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->get('label');
    }

    /**
     * @return string
     */
    public function getWidth()
    {
        return $this->get('width');
    }

    /**
     * @return string
     */
    public function getAlign()
    {
        return $this->get('align');
    }

    /**
     * @return string
     */
    public function getVAlign()
    {
        return $this->get('vAlign');
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->get('color');
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->get('type');
    }

    /**
     * @return string
     */
    public function getSorting()
    {
        return $this->get('sorting');
    }
}
<?php

namespace Lia\Bridge\DhtmlxBundle\Grid;

class Column
    extends ColumnBag
{
    /**
     * It's used for init the configuration of the columns builder
     * @var array
     */
    protected $itemsConfiguration = [
        /**
         * @var string
         */
        'label' => '',

        /**
         * @var string
         */
        'id' => '',

        /**
         * @var string
         */
        'width' => '*',

        /**
         * @var bool
         */
        'align'=> 'left',

        /**
         * @var string
         */
        'vAlign' => '',

        /**
         * @var string
         */
        'type' => 'ro',

        /**
         * @var string
         */
        'color' => '',

        /**
         * @var string
         */
        'sorting' => 'na',
    ];

    /**
     * @param string $label String who will appear in the header of column
     * @param string $id    Mapping of this column in the data source
     */
    public function __construct($label, $id)
    {
        $this->itemsConfiguration['id'   ] = $id;
        $this->itemsConfiguration['label'] = $label;
        parent::__construct($this->itemsConfiguration);
    }
}
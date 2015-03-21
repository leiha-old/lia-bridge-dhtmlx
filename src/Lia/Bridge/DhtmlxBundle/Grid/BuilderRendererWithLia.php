<?php

namespace Lia\Bridge\DhtmlxBundle\Grid;

class BuilderRendererWithLia
    extends BuilderRendererBase
{
    /**
     * @return string
     */
    protected function renderContent()
    {
        return '$lia.bridge.dhtmlx.grid'
            .'.get("'.$this->builder->getName().'", '
                .$this->builder->getAll('json')
            .')'
            .'.render();'
            . "\n"
            ;
    }
}
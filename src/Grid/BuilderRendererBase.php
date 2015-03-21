<?php

namespace Lia\Bridge\DhtmlxBundle\Grid;

abstract class BuilderRendererBase
{
    /**
     * @var Builder
     */
    protected $builder;

    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @return string
     */
    abstract protected function renderContent();

    /**
     * Allows to render the grid in html / javascript
     * @return string
     */
    public function render()
    {
        return
            '<div id="' . $this->builder->getName() . '" style="min-height:100px;"></div>' . "\n"
            . '<script type="text/javascript">' . "\n"
                . '$(function() {'. "\n"
                        .$this->renderContent()
                . '});'
            . '</script>';
    }
}
<?php

namespace Lia\Bridge\DhtmlxBundle\Grid;


interface BuilderInterface
    extends BuilderBagInterface
{
    /**
     * Set the data of grid
     * @param array $data
     * Note : If you use this method and you have set the ajax source too, this last is omitted
     * @return BuilderInterface
     */
    public function setData(array $data = []);
}
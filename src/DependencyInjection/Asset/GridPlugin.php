<?php

namespace Lia\Bridge\DhtmlxBundle\DependencyInjection\Asset;

class GridPlugin
    extends GenericPlugin
{
    /**
     * @return array
     */
    public function getJavascriptFiles()
    {
        $files = parent::getJavascriptFiles();
        $files[] = 'grid/Builder.js';
        return $files;
    }
}
<?php

namespace Lia\Bridge\DhtmlxBundle\DependencyInjection\Asset;

use Lia\Kernel\ThemeBundle\Core\PluginInterface;

class GenericPlugin
    implements PluginInterface
{
    /**
     * @var string
     */
    private $vendorJsPattern  = 'vendor/sources/dhtmlx%s/codebase/dhtmlx%s.js';

    /**
     * @var string
     */
    private $vendorCssPattern = 'vendor/sources/dhtmlx%s/codebase/skins/dhtmlx%s_dhx_%s.css';

    /**
     * Name of plugin
     * @var string
     */
    private $name = '';

    /**
     * Same thing than $name with the first letter in upper case
     * @var string
     */
    private $Name = '';

    /**
     * @var string
     */
    private $theme = '';

    /**
     * @param string $name
     * @param string $theme
     */
    public function __construct($name, $theme)
    {
        $this->name  = $name;
        $this->Name  = ucfirst($name);
        $this->theme = $theme;
    }

    /**
     * @return array
     */
    public function getCssFiles()
    {
        return [
            sprintf($this->vendorCssPattern, $this->Name, $this->name, $this->theme)
        ];
    }

    /**
     * @return array
     */
    public function getJavascriptFiles()
    {
        return [
            sprintf($this->vendorJsPattern, $this->Name, $this->name)
        ];
    }
}
<?php

namespace Lia\Bridge\DhtmlxBundle\DependencyInjection;

use Lia\Kernel\ThemeBundle\Core\SubscriberWithPluginsBase;

class ThemeSubscriberService
    extends SubscriberWithPluginsBase
{
    /**
     * @return string
     */
    public function getPathOfAsset()
    {
        return '/bundles/liabridgedhtmlx/';
    }

    /**
     * Contains available plugins for the dhtmlx library
     * if the value of item in this array is true then a custom class must be created
     * This class must be named like this : [KeyOfItem]Plugin
     * @return array
     */
    protected function getAvailablePlugins()
    {
        return [
            'accordion'  => false,
            'calendar'   => false,
            'chart'      => false,
            'colorPicker'=> false,
            'combo'      => false,
            'dataView'   => false,
            'editor'     => false,
            'form'       => false,
            'grid'       => true,
            'layout'     => false,
            'menu'       => false,
            'message'    => false,
            'popup'      => false,
            'ribbon'     => false,
            'slider'     => false,
            'tabbar'     => false,
            'toolbar'    => false,
            'tree'       => false,
            'windows'    => false,
        ];
    }

    /**
     * @return string
     */
    protected function getNameSpaceOfPlugins()
    {
        return __NAMESPACE__.'\Asset\\';
    }

    /**
     * @return array
     */
    protected function getDefaultStyleSheet()
    {
        return ['vendor/codebase/dhtmlx.css'];
    }

    /**
     * @return array
     */
    protected function getDefaultJavascript()
    {
        return ['vendor/codebase/dhtmlx.js'];
    }
}
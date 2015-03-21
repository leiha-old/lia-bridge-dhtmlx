<?php

namespace Lia\Bridge\DhtmlxBundle\DependencyInjection;

use Lia\KernelBundle\Service\ServiceBase;

class FactoryAutoService
    extends ServiceBase
{
    public function getGridFactory()
    {
        return $this->container->get('lia.factory.dhtmlx.grid');
    }
}
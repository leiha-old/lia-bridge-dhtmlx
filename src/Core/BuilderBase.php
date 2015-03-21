<?php

namespace Lia\Bridge\DhtmlxBundle\Core;

use Lia\KernelBundle\Bag\CollectionBag;
use Lia\KernelBundle\Tools\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

abstract class BuilderBase
    extends CollectionBag
    implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * @var string
     */
    private $pathOfPHPConnector;

    /**
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        parent::__construct($items);
        $this->pathOfPHPConnector = __DIR__ . '/../vendor/codebase/';
    }

    /**
     * We must override this parent hook
     *  because we need container initialized
     *   before to load the default libraries
     */
    protected function __onAfterSetContainer()
    {
        $this->load($this->getLibrariesToLoad());
    }

    /**
     * Get Dhtmlx (PHP) Libraries to load<br/>
     * Note : The connector must use a PDO Instance.<br/>
     * The library for it is loaded automatically
     * @return array
     */
    abstract protected function getLibrariesToLoad();

    /**
     * Allows to load the Dhtmlx (PHP) libraries
     * @param array $files
     * @param string $ext
     * @return void
     */
    public function load(array $files, $ext = '.php')
    {
        try {
            foreach ($files as $file) {
                include_once($this->pathOfPHPConnector . $file . $ext);
            }
        } catch (\Exception $e) {
            $log = $this->container->get('logger');
            $log->alert($e->getMessage() . ' on ' . $e->getFile() . ':' . $e->getLine());
        }
    }

}
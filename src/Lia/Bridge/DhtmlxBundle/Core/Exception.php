<?php

namespace Lia\Bridge\DhtmlxBundle\Core;

use Lia\KernelBundle\Error\ExceptionBase;

class Exception
    extends ExceptionBase
{

    /**
     * Allows get the category of context
     * @return string
     */
    function getCategoryOfContext()
    {
        return 'dhtmlx';
    }
}
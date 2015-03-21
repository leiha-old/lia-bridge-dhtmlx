<?php

namespace Lia\Bridge\DhtmlxBundle\Grid;

class BuilderRendererWithDhtmlx
    extends BuilderRendererBase
{
    /**
     * @return string
     */
    public function renderContent(){
        $name = $this->builder->getName();
        return
          $name . ' = new dhtmlXGridObject("' . $name . '");' . "\n"
        . $this->renderSourceData()
        . $this->renderDataProcessor()
        ;
    }

    /**
     * @return string
     */
    protected function renderSourceData()
    {
        $name = $this->builder->getName();
        $data = $this->builder->getData();

        $return = '';
        if (count($data)) {
            $return =
                $this->renderColumns()
                . $name . '.parse(' . json_encode($data) . ',"json");' . "\n"
                . $name . '.init();' . "\n";
        }
        elseif ($ajaxSource = $this->builder->getAjaxSource()) {
            $return =
                  $name . '.init();' . "\n"
                . $name . '.load("' . $ajaxSource . '");' . "\n";
        }
        return $return;
    }

    /**
     * @return string
     */
    protected function renderColumns()
    {
        $columns = [];
        $this->builder->iterateOnMethodsOfColumns(
            function ($dhtmlxMethod, $concat) use ($columns) {
                $columns[] = $this->builder->getName()
                    . '.' . $dhtmlxMethod[0] . '("' . implode(',', $concat) . '");' . "\n";
            }
        );
        return implode('', $columns);
    }

    /**
     * @return string
     */
    protected function renderDataProcessor()
    {
        $name = $this->builder->getName();

        $return = '';
        if ($this->builder->isDataProcessorEnabled()) {
            $return =
                  $name . 'DP = new dataProcessor("'
                    . $this->builder->getAjaxSource()
                  . '");' . "\n"
                . $name . 'DP.init("' . $name . '");' . "\n";
        }
        return $return;
    }
}
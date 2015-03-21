<?php

namespace Lia\Bridge\DhtmlxBundle\Grid;

use Lia\Bridge\DhtmlxBundle\Core\ConnectorBuilderBase;

abstract class ConnectorBuilderBag
    extends ConnectorBuilderBase
    implements ConnectorBuilderBagInterface
{
    /**
     * @param string $id
     * @return ConnectorBuilderBag
     */
    public function setSqlId($id)
    {
        return $this->add('sqlId', $id);
    }

    /**
     * @return string
     */
    public function getSqlId()
    {
        return $this->get('sqlId');
    }

    /**
     * @param string $tableName
     * @return ConnectorBuilderBag
     */
    public function setSqlTable($tableName)
    {
        return $this->add('sqlTable', $tableName);
    }

    /**
     * @return string
     */
    public function getSqlTable()
    {
        return $this->get('sqlTable');
    }

    /**
     * @param array $fields
     * @return ConnectorBuilderBag
     */
    public function setSqlFields(array $fields)
    {
        return $this->add('sqlFields', $fields);
    }

    /**
     * @param bool $enableConcat
     * @return array|string
     */
    public function getSqlFields($enableConcat=false)
    {
        return $this->_getFields('sqlFields', $enableConcat);
    }

    /**
     * @param array $fields
     * @return ConnectorBuilderBag
     */
    public function setSqlExtraFields(array $fields)
    {
        return $this->add('sqlExtraFields', $fields);
    }

    /**
     * @param bool $enableConcat
     * @return array|string
     */
    public function getSqlExtraFields($enableConcat=false)
    {
        return $this->_getFields('sqlExtraFields', $enableConcat);
    }

    /**
     * @param string $name
     * @param bool $enableConcat
     * @return array|string
     */
    private function _getFields($name, $enableConcat=false)
    {
        $field = $this->get($name);
        return $enableConcat
            ? count($field)
                ? implode(',', $field)
                : false
            : $field
            ;
    }


}
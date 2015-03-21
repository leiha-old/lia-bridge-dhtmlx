<?php

namespace Lia\Bridge\DhtmlxBundle\Grid;


interface ConnectorBuilderBagInterface
{
    /**
     * @param $id
     * @return $this
     */
    public function setSqlId($id);

    /**
     * @param $tableName
     * @return ConnectorBuilderBagInterface
     */
    public function setSqlTable($tableName);

    /**
     * @param array $fields
     * @return ConnectorBuilderBagInterface
     */
    public function setSqlExtraFields(array $fields);
}
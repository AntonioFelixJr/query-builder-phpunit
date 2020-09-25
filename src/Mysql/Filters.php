<?php

namespace QueryBuilder\Mysql;

class Filters
{

    private $sql = [];

    public function where(string $field, string $condition, $value)
    {
        $where ='WHERE %s %s %s';
        $this->sql[] = sprintf($where, $field, $condition, $value);

        return $this;
    }

    public function orderBy(string $field, string $order)
    {
        $orderBy = 'ORDER BY %s %s';
        $this->sql[] = \sprintf($orderBy, $field, $order);

        return $this;
    }

    public function getSql()
    {
        return implode(' ', $this->sql);
    }
}
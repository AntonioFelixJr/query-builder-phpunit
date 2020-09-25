<?php

namespace QueryBuilder\Mysql;

use PHPUnit\Framework\TestCase;

class FiltersTest extends TestCase
{
    public function testWhere()
    {
        $filters = new Filters();
        $filters->where('id', '=', 1);

        $actual = $filters->getSql();
        $expected = "WHERE id = 1";

        $this->assertEquals($expected, $actual);
    }

    public function testOrder()
    {
        $filters = new Filters();
        $filters->orderBy('name','ASC');

        $actual = $filters->getSql();
        $expected = "ORDER BY name ASC";

        $this->assertEquals($expected, $actual);
    }

    public function testWhereAndOrder()
    {
        $filters = new Filters();
        $filters->where('birth_date', '<=','\'2005-03-20\'');
        $filters->orderBy('name', 'DESC');

        $actual = $filters->getSql();
        $expected = "WHERE birth_date <= '2005-03-20' ORDER BY name DESC";

        $this->assertEquals($expected, $actual);
    }
}
<?php

namespace QueryBuilder\Mysql;

use PHPUnit\Framework\TestCase;

class SelectAndFiltersIntegrationTest extends TestCase
{
    public function testSelectComFiltroWhereEOrderBy()
    {
        $select = new Select();
        $select->table('users');
        $select->fields(['name', 'email']);

        $filters = new Filters();
        $filters->where('id', '>', 1000);
        $filters->orderBy('id', 'ASC');

        $select->filters($filters);

        $actual = $select->getSql();
        $expected = "SELECT name, email FROM users WHERE id > 1000 ORDER BY id ASC;";

        $this->assertEquals($expected, $actual);
    }
}
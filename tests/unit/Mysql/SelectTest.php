<?php

namespace QueryBuilder\Mysql;

use PHPUnit\Framework\TestCase;

class SelectTest extends TestCase 
{
    public function testSelectSemFiltro()
    {
        $select = new Select();
        $select->table('pages');
        $actual = $select->getSql();
        $expected = "SELECT * FROM pages;";
        $this->assertEquals($expected, $actual);

    }

    public function testSelectEspecificandoOsCampos()
    {
        $select = new Select();
        $select->table('users')
                ->fields(['name', 'birth_date']);
        
        $actual = $select->getSql();
        $expected = 'SELECT name, birth_date FROM users;';
        $this->assertEquals($expected, $actual);
    }

    public function testSelectComFiltro()
    {
        $select = new Select();
        $select->table('users');
        $select->where(['id', '=', 1]);
        $actual = $select->getSql();
        $expected = "SELECT * FROM users WHERE id = 1;";
        $this->assertEquals($expected, $actual);
    }
}
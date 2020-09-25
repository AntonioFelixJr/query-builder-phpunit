<?php

namespace QueryBuilder\Mysql;

class Select 
{

    private $table;
    private $fields = [];
    private $filters = '';
    private $where;

    public function table(string $table = null) 
    {
        $this->table = $table;

        return $this;
    }

    public function where(array $conditions = null) 
    {
        $this->where = vsprintf(
            ' WHERE %s %s %s', 
            [
                $conditions[0],
                $conditions[1],
                $conditions[2]
            ]
        );

        return $this;
    }

    public function fields(array $fields = null) 
    {
        $this->fields = $fields;

        return $this;
    }

    public function filters(Filters $filters)
    {
        $this->filters = $filters->getSql();
    }

    public function getSql() :string
    {
        $fields = '*';
        if (!empty($this->fields)) {
            $fields = implode(', ', $this->fields);
        }

        $filters = '';
        if (!empty($this->filters)) {
            $filters = ' ' . $this->filters;
        }

        $query = "SELECT %s FROM %s%s%s;";

        return vsprintf($query, [$fields, $this->table, $this->where, $filters]);
    }

    public function setWhere(array $conditions)
    {
        $whereCondition = vsprintf(
            ' WHERE %s %s %s', 
            [
                $conditions[0],
                $conditions[1],
                $conditions[2]
            ]
        );

        $this->where = $whereCondition;
    }

    public function testSelectComFiltroWhereEOrderBy()
    {
        $select = new Select();
        $select->table('users');
        $select->fields(['name', 'email']);

        $stub = $this->getMockBuilder(Filters::class)
                        ->disableOriginalConstructor()
                        ->getMock();

        $stub->method('getSql')
                ->willReturn('WHERE id > 1000 ORDER BY id ASC;');

        $select->filters($stub);

        $actual = $select->getSql();
        $expected = "SELECT name, email FROM users WHERE id > 1000 ORDER BY id ASC;";

        $this->assertEquals($expected, $actual);
    }
}
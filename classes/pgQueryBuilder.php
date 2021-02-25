<?php

class pgQueryBuilder
{
    private $db = false;
    private $fields = '';
    private $table  = '';
    private $where  = '';
    private $saveData = [];
    
    private $queryType = false;

    private $needSelect = false;
    private $needInsert = true;
    
    /*
     *      S   I
     *      0   0   
     *      0   1
     *      1   0
     *      1   1
     */

    public function __construct(pgsql $dbConnection)
    {
        $this->db = $dbConnection;
        //echo '<pre>';print_r($this->db);
    }
    
    public function insert(string $tableName, array $data)
    {
        $this->queryType = 'I';
        return $this->setSaveData($tableName, $data);
    }

    public function update(string $tableName, array $data)
    {
        $this->queryType = 'U';
        return $this->setSaveData($tableName, $data);
    }

    private function setSaveData(string $tableName, array $data)
    {
        $this->table = $tableName;
        $this->saveData = $data;
        return $this;
    }

    public function delete(string $tableName)
    {
        $this->queryType = 'D';
        return $this->from($tableName);
    }

    public function select($fields = '*')
    {
        $this->queryType = 'S';
        if (is_array($fields)) {
            $fields = implode(',', $fields);
        }
        $this->fields = $fields;
        return $this;
    }

    public function from(string $tableName)
    {
        $this->table = $tableName;
        return $this;
    }
// where 
    public function where(string $where)
    {
        $this->where = str_replace(['where', 'WHERE'], '', $where);
        $this->where = $this->where == '' ? '' : ' WHERE ' . $this->where;
        return $this;
    }
    
    public function getText()
    {
        $SQL = '';
        switch ($this->queryType) {
            case 'I':
                $SQL = 'INSERT INTO ' . $this->table . $this->insertDataSet();
                break;
            case 'U':
                $SQL = 'UPDATE ' . $this->table . ' SET ' . $this->updateDataSet() . $this->where;
                break;
            case 'S':
                $SQL = 'SELECT ' . $this->fields . ' FROM ' . $this->table . $this->where;
                break;
            case 'D':
                $SQL = 'DELETE FROM ' . $this->table . $this->where;
                break;
        }
        return $SQL;
        //$SQL = ''
    }
    
    private function updateDataSet()
    {
        $dataSet = [];
        foreach ($this->saveData as $field => $value) {
            $dataSet[] = $field . "='" . $this->db->escape($value) . "'";
        }
        return implode(',', $dataSet);
    }
    
    private function insertDataSet()
    {
        $fields = '(' . implode(',', array_keys($this->saveData)) . ')';
        $values = "('" . implode("','", $this->saveData) . "')";
        return $fields . ' VALUES ' . $values;
    }
    
    public function query()
    {
        $sql = $this->getText();
        $res = $this->queryType == 'S' ? $this->db->querySelect($sql) : $this->db->query($sql);
        $this->fields = '';
        $this->table  = '';
        $this->where  = '';
        $this->saveData = [];
        return $res;
    }
}

//$command = new pgQueryBuilder();
/*
$command->from('test')->where('id = 2')->select('*')->query();
$command->from('test')->select('*')->where('id = 2')->query();
$sql = $command->select('*')->from('test')->where('id = 2')->getText();//->query();
$cmd2 = new pgQueryBuilder();
$cmd2->select('*')->from('users')->where('id in ( ' . $sql . ' )');
/**/
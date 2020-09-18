<?php

class ApiModels extends Models{
    protected $tableContry = 'contry';

    public function __construct(){
        parent::__construct();
        $this->setTable($this->tableContry);
    }

    public function insertData($aryData){
        foreach ($aryData as $data){
            $this->insert($data);
        }
        return true;
    }

}
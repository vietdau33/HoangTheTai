<?php

class ContryModels extends Models{
    protected $tableContry = 'contry';

    public function __construct(){
        parent::__construct();
        $this->setTable($this->tableContry);
    }

}
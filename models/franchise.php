<?php

class FranchiseModels extends Models{
    protected $table = 'franchise';

    public function __construct(){
        parent::__construct();
        $this->setTable($this->table);
    }

}
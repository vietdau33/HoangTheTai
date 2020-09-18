<?php

class FranchiseRequestModels extends Models{
    protected $table = 'franchise_request';

    public function __construct(){
        parent::__construct();
        $this->setTable($this->table);
    }

    public function getFranchiseRequest($userRequest = null, $page = 1, $search = null){
        $arySelect = [
            'id' => 'franchise_request.id',
            'user_request_name' => 'member.username',
            'user_request' => 'franchise_request.user_request',
            'type_request' => 'franchise.name',
            'user_enter' => 'franchise_request.user_enter',
            'franchise_date' => 'date(franchise_request.created_at)',
            'active' => 'franchise_request.active_flag'
        ];

        $sql  = 'SELECT ' . $this->_buildSelect($arySelect) . ' FROM franchise_request';
        $sql .= ' LEFT JOIN member ON franchise_request.user_request = member.id';
        $sql .= ' LEFT JOIN franchise ON franchise_request.type_request = franchise.id';

        $aryWhere = [];
        if($userRequest != null){
            $aryWhere[] = 'franchise_request.user_request = "' . $userRequest . '"';
        }
        if($search != null){
            $aryWhere[] = 'LOWER(franchise_request.user_enter) = "' . strtolower($search) . '"';
        }
        if(!empty($aryWhere)){
            $sql .= ' WHERE ' . implode(' AND ', $aryWhere);
        }
        $sql .= ' order by franchise_request.active_flag ASC, franchise_request.created_at DESC';
        return $this->paggination($sql, $page);
    }
}
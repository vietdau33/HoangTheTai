<?php

class UpgradeRequestModels extends Models{
    protected $table = 'upgrade_request';

    public function __construct(){
        parent::__construct();
        $this->setTable($this->table);
    }

    public function getRequest($userRequest = null, $page = 1, $search = null){
        $arySelect = [
            'id' => 'upgrade_request.id',
            'user_enter' => 'upgrade_request.user_enter',
            'user_request' => 'upgrade_request.user_request',
            'type_request' => 'upgrade_request.type_request',
            'license' => 'franchise.license',
            'date_request' => 'date(upgrade_request.created_at)',
            'approved' => 'upgrade_request.approved'
        ];
        $sql = 'SELECT ' . $this->_buildSelect($arySelect) . ' FROM upgrade_request';
        $sql .= ' LEFT JOIN member ON upgrade_request.user_request = member.id';
        $sql .= ' LEFT JOIN franchise ON upgrade_request.type_request = franchise.type';

        $aryWhere = [];
        if($userRequest != null){
            $aryWhere[] = 'upgrade_request.user_request = "' . $userRequest . '"';
        }
        if($search != null){
            $aryWhere[] = 'LOWER(upgrade_request.user_enter) = "' . strtolower($search) . '"';
        }
        if(!empty($aryWhere)){
            $sql .= ' WHERE ' . implode(' AND ', $aryWhere);
        }
        $sql .= ' order by upgrade_request.approved ASC, upgrade_request.created_at DESC';
//        print_r($sql);die;
        return $this->paggination($sql, $page);
    }

}
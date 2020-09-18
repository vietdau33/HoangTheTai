<?php

class MemberModels extends Models{
    protected $table = 'member';

    public function __construct(){
        parent::__construct();
        $this->setTable($this->table);
    }

    public function getInfo($id){
        $arySelect = [
            'member.id'                     => 'id',
            'member.username'               => 'username',
            'member.token'                  => 'token',
            'member.time_create_token'      => 'time_create_token',
            'member.license'                => 'license',
            'member.license_remaining'      => 'license_remaining',
            'member.permision'              => 'permision',
            'franchise.name'                => 'franchise',
            'franchise.type'                => 'franchise_type',
            'member.franchise'              => 'franchise_id',
            'member.franchise_date'         => 'franchise_date',
            'member.fullname'               => 'fullname',
            'member.email'                  => 'email',
            'member.phone'                  => 'phone',
            'contry.name'                   => 'name',
            'contry.flag'                   => 'flag',
            'contry.alpha2Code'             => 'alpha2Code',
            'member.contry'                 => 'contry',
            'member.support_fees'           => 'support_fees',
            'member.income_franchise'       => 'income_franchise',
            'member.income_mib'             => 'income_mib',
        ];
        $select = $this->_buildSelect(array_flip($arySelect));
        $sql = 'SELECT ' .$select . ' FROM member LEFT JOIN contry ON member.contry = contry.id LEFT JOIN franchise on member.franchise = franchise.id WHERE member.id = "' . $id . '"';
        return $this->query($sql)[0] ?? [];
    }
    public function getMember($page = 1, $search = null, $getUserAdmin = false){
        $arySelect = $this->arySelectMember();

        $sql  = 'SELECT ' . $this->_buildSelect($arySelect) . ' FROM member';
        $sql .= ' LEFT JOIN franchise ON franchise.id = member.franchise';

        $aryWhere = [];
        if(!$getUserAdmin){
            $aryWhere[] = 'member.permision <> "1"';
        }
        if($search != null){
            $aryWhere[] = 'member.username LIKE "' . $search . '%"';
        }
        if(!empty($aryWhere)){
            $sql .= ' WHERE ' . implode(' AND ', $aryWhere);
        }
        $sql .= ' order by member.updated_at DESC';
        $dataPaginition = [];
        if($page == null){
            $dataPaginition['data'] = $this->query($sql);
        }else{
            $dataPaginition = $this->paggination($sql, $page);
        }
        $dataTempGetEnterPrise = [];
        foreach ($dataPaginition['data'] as $key => $data){
            $data['enterprise'] = $this->setGet(['username'])->one(['id' => $data['enterprise']])['username'] ?? 'Not See';
            $dataTempGetEnterPrise[] = $data;
        }
        $dataPaginition['data'] = $dataTempGetEnterPrise;
        return $dataPaginition;
    }

    private function arySelectMember(){
        return [
            'id'                    => 'member.id',
            'username'              => 'member.username',
            'franchise'             => 'franchise.name',
            'franchise_date'        => 'member.franchise_date',
            'license'               => 'member.license',
            'license_remaining'     => 'member.license_remaining',
            'fullname'              => 'member.fullname',
            'email'                 => 'member.email',
            'phone'                 => 'member.phone',
            'support_fees'          => 'member.support_fees',
            'income_franchise'      => 'member.income_franchise',
            'income_mib'            => 'member.income_mib',
            'enterprise'            => 'member.parent_enterprise',
            'active'                => 'member.active',
            'active_date'           => 'member.active_date',
        ];
    }

    public function getUserList($id, $page = 1){
        $arySelect = $this->arySelectMember();

        $sql  = 'SELECT ' . $this->_buildSelect($arySelect) . ' FROM member';
        $sql .= ' LEFT JOIN franchise ON franchise.id = member.franchise';
        $sql .= ' WHERE member.parent_create = "' . $id . '"';
        $sql .= ' order by member.updated_at DESC';
        $dataPaginition = $this->paggination($sql, $page);
        $dataTempGetEnterPrise = [];
        foreach ($dataPaginition['data'] as $key => $data){
            $data['enterprise'] = $this->setGet(['username'])->one(['id' => $data['enterprise']])['username'] ?? 'Not See';
            $sqlSelectDownline = 'SELECT count(id) as downline FROM member where parent_create = "' . $data['id'] . '"';
            $downline = $this->query($sqlSelectDownline);
            $data['downline'] = $downline[0]['downline'] ?? 'NaN';
            $dataTempGetEnterPrise[] = $data;
        }
        $dataPaginition['data'] = $dataTempGetEnterPrise;
        return $dataPaginition;
    }

}
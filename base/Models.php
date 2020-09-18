<?php

class Models extends PdoConnect {

    public function __construct(){
        parent::__construct();
    }

    public function _buildSelect(array $arySelect){
        $result = [];
        foreach ($arySelect as $key => $item) {
            $result[] = $item . ' as ' . $key;
        }
        return implode(', ', $result);
    }

    public function paggination($sql, $page = 1){
        $limit = (int)config('app', 'limit_one_page');
        $allRecord = count($this->query($sql));
        if($allRecord == 0){
            $allRecord = 1;
        }
        $getBegin = (int)$page * $limit - $limit;
        $sql .= ' limit '. $getBegin . ', ' . $limit;
        $result = $this->query($sql);
        return [
            'pageNow' => $page,
            'allPage' => ceil($allRecord / $limit),
            'data' => $result == '' ? [] : $result
        ];
    }

}
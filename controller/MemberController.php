<?php
class MemberController extends Controller{
    private $member;
    private $userLogin;
    private $franchise;
    private $upgradeRequest;

    public function __construct(){
        parent::__construct();
        $this->member           = new MemberModels();
        $this->userLogin        = new Session('logined');
        $this->franchise        = new FranchiseModels();
        $this->upgradeRequest   = new UpgradeRequestModels();
        if($this->userLogin->get('hasLogin') && $this->member->setGet(['active'])->one(['id' => $this->userLogin->get('id')])['active'] == '0'){
            return redirect('login/logout');
        }
    }
    public function create_user(){
        if(!$this->isAjax()){
            return response([
                'code' => 403,
                'message' => __('permision_diened')
            ]);
        }
        $params    = $this->post('params');
        if(isset($params['username_copy_trading'])){
            unset($params['username_copy_trading']);
        }

        $erros = $this->validateDataCreateuser($params);

        if(!empty($erros)){
            return response([
                'code' => 205,
                'message' => implode('\n', $erros)
            ]);
        }

        if(!isset($params['is_update'])){
            $getUser = $this->member->one(['username' => $params['username']]);
            if(!!$getUser){
                return response([
                    'code' => 205,
                    'message' => __('username_has_exists')
                ]);
            }
        }

        $password = $this->hash_password($params['password']);
        $franchiseInfo = $this->franchise->one(['id' => $params['franchise']]);
        if(!$franchiseInfo){
            return response([
                'code' => 205,
                'message' => __('get_franchise_info_error')
            ]);
        }
        $userLoginId = $this->userLogin->get('id');
        if(strtolower($this->userLogin->get('franchise')) == 'enterprise'){
            $parentEnterprise = $userLoginId;
        }else{
            $parentEnterprise = $this->member->setGet(['parent_enterprise'])->one(['id' => $userLoginId])['parent_enterprise'] ?? '';
        }
        $action = 'insert';
        $_where = null;
        $aryInsert = [
            'franchise'         => $params['franchise'],
            'franchise_date'    => date('d-m-Y'),
            'username'          => $params['username'],
            'password'          => $password,
            'fullname'          => $params['fullname'],
            'email'             => $params['email'],
            'phone'             => $params['phone'],
            'contry'            => $params['contry'],
            'parent_create'     => $userLoginId,
            'parent_enterprise' => $parentEnterprise,
            'license'           => $franchiseInfo['license'],
            'license_remaining' => $franchiseInfo['license']
        ];
        if(isset($params['is_update']) && $params['is_update'] == '1'){
            $aryInsert = [
                'fullname'          => $params['fullname'],
                'email'             => $params['email'],
                'phone'             => $params['phone'],
                'contry'            => $params['contry'],
            ];
            $action = 'update';
            $_where['id'] = $this->userLogin->get('id');
        }

        if(!$this->member->{$action}($aryInsert, $_where)){
            return response([
                'code' => 203,
                'message' => "Error"
            ]);
        }

        return response([
            'code' => 200,
            'message' => 'Success'
        ]);
    }
    public function admin_create_user(){
        if(!$this->isAjax()){
            return response([
                'code' => 403,
                'message' => __('permision_diened')
            ]);
        }
        $params = $this->post('params');
        $getUser = $this->member->one(['username' => $params['username']]);

        if(!!$getUser){
            return response([
                'code' => 205,
                'message' => __('username_has_exists')
            ]);
        }

        $password = $this->hash_password($params['password']);
        $franchiseInfo = $this->franchise->one(['type' => 'enterprise']);
        if(!$franchiseInfo){
            return response([
                'code' => 205,
                'message' => __('get_franchise_info_error')
            ]);
        }
        $userLoginId = $this->userLogin->get('id');
        $aryInsert = [
            'franchise'         => $franchiseInfo['id'],
            'franchise_date'    => date('d-m-Y'),
            'username'          => $params['username'],
            'password'          => $password,
            'parent_create'     => $userLoginId,
            'parent_enterprise' => $userLoginId,
            'license'           => $franchiseInfo['license'],
            'license_remaining' => $franchiseInfo['license'],
            'active'            => '1'
        ];

        if(!$this->member->insert($aryInsert)){
            return response([
                'code' => 203,
                'message' => __('create_user_error')
            ]);
        }

        $html = $this->render('admin.table_member');
        return response([
            'code' => 200,
            'message' => __('create_user_success'),
            'html' => $html
        ]);
    }
    public function change_password(){
        if(!$this->isAjax()){
            return response([
                'code' => 403,
                'message' => __('permision_diened')
            ]);
        }
        $params    = $this->post('params');
        $id        = $params['id'] ?? $this->userLogin->get('id') ?? '';
        $password  = $params['password'] ?? '';
        if($id == '' || $password == ''){
            return response([
                'code' => 204,
                'message' => __('not_found_id_or_new_password')
            ]);
        }
        $tryGetUser = $this->member->one(['id' => $id]);
        if(!$tryGetUser){
            return response([
                'code' => 205,
                'message' => __('not_found_user_in_db')
            ]);
        }

        $password = $this->hash_password($password);
        $aryUpdate = [
            'password' => $password
        ];
        $type = $params['type'] ?? '';
        if($type == 'first'){
            $aryUpdate['count_login'] = 1;
        }
        if(!$this->member->update($aryUpdate, ['id' => $id])){
            return response([
                'code' => 207,
                'message' => __('update_password_user_error')
            ]);
        }
        $this->userLogin->set('count_login', '1');
        return response([
            'code' => 200,
            'message' => __('update_password_user_success')
        ]);
    }
    public function upgrade(){
        if(!$this->isAjax()){
            return response([
                'code' => 403,
                'message' => __('permision_diened')
            ]);
        }
        $type = $this->post('params')['type'] ?? '';
        if($type == ''){
            return response([
                'code' => 207,
                'message' => __('type_upgrade_not_found')
            ]);
        }
        $aryInsert = [
            'user_enter' => $this->userLogin->get('username'),
            'user_request' => $this->userLogin->get('username'),
            'type_request' => $this->userLogin->get('franchise_type') == 'enterprise' ? 'enterprise' : $type
        ];
        if(!$this->upgradeRequest->insert($aryInsert)){
            return response([
                'code' => 205,
                'message' => __('upgrade_request_error')
            ]);
        }
        return response([
            'code' => 200,
            'message' => __('upgrade_request_success')
        ]);
    }
    public function getInfo(){
        $id = $this->userLogin->get('id');
        if(!$id){
            return response([
                'code' => 403,
                'message' => __('permision_diened')
            ]);
        }
        return $this->member->getInfo($id);
    }

    private function validateDataCreateuser($params){
        $error = [];
        foreach ($params as $key => $param) {
            $err_flag = false;
            if($param == ''){
                $err_flag = true;
                $error[] = $key . ': Data empty!';
            }
            if($err_flag) continue;

            switch ($key) {
                case 'email' :
                    if (!filter_var($param, FILTER_VALIDATE_EMAIL)){
                        $err_flag = true;
                        $error[] = $key . ': Email not valid!';
                    }
                    break;
                case 'contry' :
                    if($param == '--dd'){
                        $err_flag = true;
                        $error[] = $key . ': Country not valid!';
                    }
                    break;
            }
        }
        return $error;
    }

    public function adminGetUser(){
        if(!$this->isAjax() || $this->userLogin->get('permision') != '1'){
            return response([
                'code' => 403,
                'message' => __('permision_diened')
            ]);
        }
        $params = $this->post('params');
        $usernameSearch = $params['username'] ?? '';
        $page = $params['page'] ?? '1';
        $usernameSearch = str_replace(['\\', '*','"', '_'], ['\\\\', '\*', '\"', '\_'], $usernameSearch);
        $html = $this->render('admin.table_member', ['search' => $usernameSearch, 'page' => $page]);
        return response([
            'code' => 200,
            'message' => "Search Success!",
            'html' => $html
        ]);
    }

    public function toggleActiveUser(){
        if(!$this->isAjax() || $this->userLogin->get('permision') != '1'){
            return response([
                'code' => 403,
                'message' => __('permision_diened')
            ]);
        }
        $params = $this->post('params');
        $userId = $params['id'] ?? '';
        if($userId == ''){
            return response([
                'code' => 403,
                'message' => __('permision_diened')
            ]);
        }
        $userToggle = $this->member->setGet([
            'active',
            'parent_create',
            'parent_enterprise',
            'franchise'
        ])->one(['id' => $userId]);

        $userCreate = $this->member->setGet([
            'id',
            'permision',
            'income_franchise',
            'franchise'
        ])->one(['id' => $userToggle['parent_create']]);

        $activeFlag = $userToggle['active'];
        $franchiseInfo = $this->franchise->setGet([
            'id',
            'type',
            'investment'
        ])->one(['id' => $userToggle['franchise']]);

        if($userCreate['permision'] != '1'){
            $isOkToggleActive = $this->_toggleActiveUser($franchiseInfo, $userCreate, $userToggle['parent_enterprise'], $activeFlag == '1');
            if(!empty($isOkToggleActive)){
                return response([
                    'code' => 204,
                    'message' => 'Toggle Active Error!',
                    'error' => $isOkToggleActive
                ]);
            }
        }

        if(!$this->member->update([
            'active' => $activeFlag == '1' ? '0' : '1',
            'active_date' => $activeFlag == '1' ? '' : date('d-m-Y')
        ], ['id' => $userId])){
            return response([
                'code' => 205,
                'message' => 'Toggle Active Error!'
            ]);
        }

        return response([
            'code' => 200,
            'message' => 'Success!',
            'active' => $activeFlag == '1' ? '0' : '1'
        ]);

    }

    private function _toggleActiveUser($franchiseInfo, $userCreate, $userEnterpriseId, $deactive){
        $aryError = [];

        $investment = $franchiseInfo['investment'];
        $investment20 = $investment * 0.2;
        $investment70 = $investment * 0.7;
        if($deactive){
            $userCreate['income_franchise'] = (int)$userCreate['income_franchise'] - $investment70;
            if($userCreate['franchise'] == '4'){
                $userCreate['income_franchise'] = $userCreate['income_franchise'] - $investment20;
            }
        }else{
            $userCreate['income_franchise'] = (int)$userCreate['income_franchise'] + $investment70;
            if($userCreate['franchise'] == '4'){
                $userCreate['income_franchise'] = $userCreate['income_franchise'] + $investment20;
            }
        }

        if(!$this->member->update(['income_franchise' => $userCreate['income_franchise']], ['id' => $userCreate['id']])){
            $aryError = [
                'code' => '207',
                'message' => 'update user create error'
            ];
        }

        if(!empty($aryError) || $userCreate['franchise'] == '4'){
            return $aryError;
        }

        $userEnterprise = $this->member->setGet([
            'id',
            'income_franchise',
            'support_fees'
        ])->one(['id' => $userEnterpriseId]);

        if($deactive){
            $userEnterprise['support_fees'] = (int)$userEnterprise['support_fees'] - $investment20;
        }else{
            $userEnterprise['support_fees'] = (int)$userEnterprise['support_fees'] + $investment20;
        }

        if(!$this->member->update(['support_fees' => $userEnterprise['support_fees']], ['id' => $userEnterpriseId])){
            $aryError = [
                'code' => '207',
                'message' => 'update user enterprise error'
            ];
        }

        return $aryError;
    }

    public function getUserEdit(){
        if(!$this->isAjax()){
            return response([
                'code' => 403,
                'message' => __('permision_diened')
            ]);
        }
        $userId = $this->userLogin->get('id');
        $userInfo = $this->member->getInfo($userId);
        $userReturn = [
            'username' => $userInfo['username'],
            'password' => '*********',
            'fullname' => $userInfo['fullname'],
            'email' => $userInfo['email'],
            'phone' => $userInfo['phone'],
            'contry' => $userInfo['contry'] ?? '--dd',
            'franchise' => $userInfo['franchise_id'],
        ];
        return response([
            'code' => 200,
            'data' => $userReturn
        ]);
    }
}
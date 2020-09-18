<?php

class UpgradeRequestController extends Controller{

    protected $upgradeRequest;
    protected $member;
    protected $franchise;
    protected $userLogin;

    public function __construct(){
        parent::__construct();
        $this->upgradeRequest = new UpgradeRequestModels();
        $this->member = new MemberModels();
        $this->franchise = new FranchiseModels();
        $this->userLogin = new Session('logined');
        if($this->hasNotLogin()){
            die();
        }
        if($this->userLogin->get('hasLogin') && $this->member->setGet(['active'])->one(['id' => $this->userLogin->get('id')])['active'] == '0'){
            return redirect('login/logout');
        }
    }

    public function hasNotLogin(){
        if(!$this->userLogin->get('hasLogin')){
            return response([
                'code' => 403,
                'message' => __('permision_diened')
            ]);
        }
        return false;
    }

    public function getRequest($getData = false){
        if(!$this->isAjax() && !$getData){
            return response([
                'code' => 403,
                'message' => __('permision_diened')
            ]);
        }
        $isUser = false;
        $userRequest = null;
        if($this->userLogin->get('permision') != '1'){
            $userRequest = $this->userLogin->get('username');
            $isUser = true;
        }
        $page = (int)($this->post('params')['p'] ?? 0);
        $search = $this->post('params')['search'] ?? null;
        if($page == 0){
            $page = 1;
        }
        if($isUser){
            $upgradeRequest = $this->upgradeRequest->getRequest($userRequest, $page, $search);
        }else{
            $type = $search['type'] ?? null;
            if($type == '1'){
                $upgradeRequest = $this->upgradeRequest->getRequest($userRequest, $page, $search['search']);
            }else if($type == '2'){
                $upgradeRequest = $this->upgradeRequest->getRequest($search['search'], $page);
            }else{
                $upgradeRequest = $this->upgradeRequest->getRequest($userRequest, $page, $search);
            }
        }
        if(!$upgradeRequest){
            $upgradeRequest = [];
        }
        if(!$isUser){
            $userRequest = $this->member->getWithCodition('permision', '<>', '1');
        }
        $html = $this->render('admin.upgrade_request', [
            'data' => $upgradeRequest,
            'isUser' => $isUser,
            'search' => $search ?? '',
            'userRequest' => $userRequest ?? []
        ]);
        if($getData){
            return $html;
        }
        return response([
            'code' => 200,
            'html' => $html
        ]);
    }

    public function approveRequest(){
        if(!$this->isAjax()){
            return response([
                'code' => 403,
                'message' => __('permision_diened')
            ]);
        }
        $id = $this->post('params')['id'] ?? '';
        if($id == ''){
            return response([
                'code' => 207,
                'message' => __('id_upgrade_not_found')
            ]);
        }
        $upgradeRequest = $this->upgradeRequest->one(['id' => $id]);
        if(!$upgradeRequest){
            return response([
                'code' => 207,
                'message' => __('upgrade_request_not_found')
            ]);
        }
        $userInfo = $this->member->one(['username' => $upgradeRequest['user_request']]);
        if(!$userInfo){
            return response([
                'code' => 207,
                'message' => __('user_request_not_found')
            ]);
        }
        $franchise = $this->franchise->one(['type' => $upgradeRequest['type_request']]);
        if(!$franchise){
            return response([
                'code' => 207,
                'message' => __('franchise_request_not_found')
            ]);
        }
        $license = (int)$franchise['license'];
        $aryUpdateMember = [
            'license' => (int)$userInfo['license'] + $license,
            'license_remaining' => (int)$userInfo['license_remaining'] + $license,
            'franchise' => $franchise['id'],
            'franchise_date' => date('d-m-Y')
        ];
        if(!$this->member->update($aryUpdateMember, ['username' => $upgradeRequest['user_request']])){
            return response([
                'code' => 205,
                'message' => __('update_license_user_error')
            ]);
        }
        if(!$this->upgradeRequest->update(['approved' => 1], ['id' => $id])){
            return response([
                'code' => 205,
                'message' => __('update_upgrade_request_error')
            ]);
        }
        return response([
            'code' => 200,
            'message' => __('update_upgrade_request_success'),
            'text' => 'Approved'
        ]);
    }
}
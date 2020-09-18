<?php

class FranchiseRequestController extends Controller{
    protected $userLogin;
    protected $franchiseRequest;
    protected $franchise;
    protected $member;

    public function __construct(){
        parent::__construct();
        $this->userLogin        = new Session('logined');
        $this->franchiseRequest = new FranchiseRequestModels();
        $this->franchise        = new FranchiseModels();
        $this->member           = new MemberModels();
        if($this->userLogin->get('hasLogin') && $this->member->setGet(['active'])->one(['id' => $this->userLogin->get('id')])['active'] == '0'){
            return redirect('login/logout');
        }
        $this->checkLogin();
    }

    public function checkLogin(){
        if(!$this->userLogin->get('hasLogin')){
            return redirect(BASE_URL . '/login');
        }
    }

    public function createFranchiseRequest(){
        if(!$this->isAjax()){
            return response([
                'code' => 403,
                'message' => __('permision_diened')
            ]);
        }
        $params = $this->post('params');
        if(
            !isset($params['user_enter'])
            || !isset($params['type_request'])
            || trim($params['user_enter']) == ''
            || trim($params['type_request']) == ''
        ){
            return response([
                'code' => 203,
                'message' => __('not_see_type_request_and_user_enter')
            ]);
        }
        if($this->userLogin->get('permision') == 1){
            return response([
                'code' => 306,
                'message' => __('admin_can_not_create_franchise_request')
            ]);
        }
        if(!!$this->franchiseRequest->one([
            'user_enter' => trim($params['user_enter']),
            'active_flag' => 0,
            'user_request' => $this->userLogin->get('id')
        ])){
            return response([
                'code' => 204,
                'message' => __('have_one_request_pending_active_with_username') . ' "' . trim($params['user_enter']) . '"'
            ]);
        }
        $params['user_request'] = $this->userLogin->get('id');
        if(!$this->franchiseRequest->insert($params)){
            return response([
                'code' => 205,
                'message' => __('insert_request_franchise_error')
            ]);
        }
        return response([
            'code' => 200,
            'message' => __('create_request_franchise_success')
        ]);
    }

    public function request_history($getData = false){
        if(!$this->isAjax()){
            return response([
                'code' => 403,
                'message' => __('permision_diened')
            ]);
        }
        $isUser = false;
        $userRequest = null;
        if($this->userLogin->get('permision') != '1'){
            $userRequest = $this->userLogin->get('id');
            $isUser = true;
        }
        $page = (int)($this->post('params')['p'] ?? 0);
        $search = $this->post('params')['search'] ?? null;
        if($page == 0){
            $page = 1;
        }
        if($isUser){
            $request = $this->franchiseRequest->getFranchiseRequest($userRequest, $page, $search);
        }else{
            $type = $search['type'] ?? null;
            if($type == '1'){
                $request = $this->franchiseRequest->getFranchiseRequest($userRequest, $page, $search['search']);
            }else if($type == '2'){
                $request = $this->franchiseRequest->getFranchiseRequest($search['search'], $page);
            }else{
                $request = $this->franchiseRequest->getFranchiseRequest($userRequest, $page, $search);
            }
        }
        if(!$request){
            $request = [];
        }
        if(!$isUser){
            $userRequest = $this->member->getWithCodition('permision', '<>', '1');
        }
        if(!empty($request)){
            $aryDataRequestTemp = [];
            $allMember = $this->member->getMember(null)['data'];
            foreach ($request['data'] as $req){
                $req['data-user'] = $this->getAryUserOnRequest($allMember, $req['user_request']);
                $aryDataRequestTemp[] = $req;
            }
            $request['data'] = $aryDataRequestTemp;
        }
        $compact = [
            'allowShowBgHeader' => false,
            'data' => $request,
            'isUser' => $isUser,
            'search' => $search ?? '',
            'userRequest' => $userRequest ?? []
        ];
        $html = $this->render('admin.request_history', $compact);
        if(!$getData){
            return response([
                'code' => 200,
                'html' => $html
            ]);
        }
        return $html;
    }

    private function getAryUserOnRequest($aryMember, $idMember){
        foreach ($aryMember as $member){
            if($member['id'] == $idMember){
                return $member;
            }
        }
    }

    public function toggleActiveRequest(){
        if(!$this->isAjax()){
            return response([
                'code' => 403,
                'message' => __('permision_diened')
            ]);
        }
        $id = $this->post('params')['id'] ?? '';
        if($id == ''){
            return response([
                'code' => 203,
                'message' => __('not_see_id_toggle')
            ]);
        }
        $getInfoFranchRequest = $this->franchiseRequest->one(['id' => $id]);
        if(!$getInfoFranchRequest){
            return response([
                'code' => 203,
                'message' => __('not_see_id_franch_request_in_db')
            ]);
        }

        $active = $getInfoFranchRequest['active_flag'] == '1' ? '0' : '1';

        $getMemberRequestInfo = $this->member->one(['id' => $getInfoFranchRequest['user_request']]);
        if(!$getMemberRequestInfo){
            return response([
                'code' => 203,
                'message' => __('get_member_info_error')
            ]);
        }
        $license = (int)$getMemberRequestInfo['license_remaining'];
        $income_mib = (int)$getMemberRequestInfo['income_mib'];

        if($license <= 0){
            return response([
                'code' => 300,
                'message' => __('license_remaining_not_enaugh')
            ]);
        }

        $aryUpdateMember = [];
        if($active == '1'){
            $aryUpdateMember['license_remaining'] = $license - 1;
            $aryUpdateMember['income_mib'] = $income_mib + config('app', 'income_mib');
        }else{
            $aryUpdateMember['license_remaining'] = $license + 1;
            $aryUpdateMember['income_mib'] = $income_mib - config('app', 'income_mib');
        }
        if(!$this->member->update($aryUpdateMember, ['id' => $getInfoFranchRequest['user_request']])){
            return response([
                'code' => 207,
                'message' => __('update_license_remaining_error')
            ]);
        }

        $aryUpdate = [
            'active_flag' => $active,
            'user_approve' => $this->userLogin->get('username'),
            'time_approve' => date('H:m:s d-m-Y')
        ];
        if(!$this->franchiseRequest->update($aryUpdate, ['id' => $id])){
            return response([
                'code' => 203,
                'message' => __('update_franchise_request_error')
            ]);
        }
        return response([
            'code' => 200,
            'message' => __('update_franchise_request_success'),
            'text' => $active == '1' ? 'Deactive' : 'Active',
            'btn' => $active == '1' ? 'danger' : 'success'
        ]);
    }

    public function deleteRequest(){
        if(!$this->isAjax()){
            return response([
                'code' => 403,
                'message' => __('permision_diened')
            ]);
        }
        $id = $this->post('params')['id'] ?? '';
        if($id == ''){
            return response([
                'code' => 203,
                'message' => __('not_see_id_remove')
            ]);
        }
        $getInfoFranchRequest = $this->franchiseRequest->one(['id' => $id]);
        if(!$getInfoFranchRequest){
            return response([
                'code' => 203,
                'message' => __('not_see_id_franch_request_in_db')
            ]);
        }
        if(!$this->franchiseRequest->delete(['id' => $id])){
            return response([
                'code' => 203,
                'message' => __('delete_franchise_request_error')
            ]);
        }
        return response([
            'code' => 200,
            'message' => __('delete_franchise_request_success')
        ]);
    }

}
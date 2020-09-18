<?php

class HomeController extends Controller {
    public $userLogin;
    private $franchise;
    private $member;
    private $userListIdQuery;

    public function __construct(){
        parent::__construct();
        $this->userLogin = new Session('logined');
        $this->userListIdQuery = new Session('userListQuery');
        $this->franchise = new FranchiseModels();
        $this->member    = new MemberModels();
        if($this->userLogin->get('hasLogin') && $this->member->setGet(['active'])->one(['id' => $this->userLogin->get('id')])['active'] == '0'){
            return redirect('login/logout');
        }
    }
    public function index($getData = false){
        if(!$this->userLogin->get('hasLogin')){
            $mess = __('first_please_login');
            return $this->view('login.index', ['message' => $mess, 'type' => 'warning', 'isLogin' => true]);
        }
        if($this->userLogin->get('count_login') == 0){
            $mess = 'Congratilations! Your accoutn has been approved by Admin. <br>For the first time, please create your new own password';
            return $this->view('login.change_password', ['message' => $mess, 'type' => 'light', 'isChangePassword' => true]);
        }
        if($this->userLogin->get('permision') == '1'){
            return redirect('admin');
        }
        $franchise = $this->franchise->all();
        $params = [
            'allowShowBgHeader' => true,
            'page_user' => true,
            'franchise' => $franchise
        ];
        if($getData){
            return $this->render('home.index', $params);
        }
        return $this->view('home.index', $params);
    }
    public function userList($getData = false){
        if(!$this->isAjax()){
            return response([
                'code' => 403,
                'message' => __('permision_diened')
            ]);
        }
        $params = $this->post('params') ?? [];
        $page = $params['p'] ?? '1';
        $userId = $params['userId'] ?? $this->userLogin->get('id');
        $isAjax = $params['_is_call'] ?? '0';
        if($isAjax == '0'){
            $this->userListIdQuery->die();
            $this->userListIdQuery = new Session('userListQuery');
        }elseif((isset($params['pagging']) && $params['pagging'] == '1')){
            $listUser = $this->userListIdQuery->get();
            $userId = $listUser[count($listUser) - 1] ?? $this->userLogin->get('id');
        }elseif(isset($params['back']) && $params['back'] == '1'){
            $listUser = $this->userListIdQuery->get();
            array_splice($listUser,count($listUser) - 1);
            $userId = array_splice($listUser,count($listUser) - 1);
            $userId = $userId[0] ?? $this->userLogin->get('id');
            $this->userListIdQuery->set('', array_values($listUser), true);
            $this->userListIdQuery->put($userId);
        }else{
            $this->userListIdQuery->put($userId);
        }
        $html = $this->render('home.user_list', ['page' => $page, 'userId' => $userId]);
        if($isAjax == '1'){
            return response([
                'code' => 200,
                'html' => $html
            ]);
        }
        return $html;
    }
    public function getHtmlMenuPage(){
        if(!$this->isAjax()){
            return response([
                'code' => 403,
                'message' => __('permision_diened')
            ]);
        }
        $params = $this->post('params');
        $page = $params['page'] ?? '';
        if($page == ''){
            return response([
                'code' => 205,
                'message' => __('page_not_found')
            ]);
        }

        $html = '';
        switch ($page){
            case 'request_submit_history' :
                $html = $this->call('FranchiseRequest@request_history');
                break;
            case 'home' :
                $html = $this->call('Home@index');
                break;
            case 'admin_home' :
                $html = $this->call('Admin@index');
                break;
            case 'upgrade_request' :
                $html = $this->call('UpgradeRequest@getRequest');
                break;
            case 'user_list' :
                $html = $this->call('Home@userList');
                break;
        }

        if($html == ''){
            return response([
                'code' => 205,
                'message' => __('page_not_found')
            ]);
        }

        return response([
            'code' => 200,
            'html' => $html
        ]);
    }
}
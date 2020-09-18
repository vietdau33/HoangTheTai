<?php

class AdminController extends Controller{
    public $userLogin;
    private $franchise;
    private $member;
    private $franchiseRequest;
    private $errors;

    public function __construct(){
        parent::__construct();
        $this->userLogin        = new Session('logined');
        $this->errors           = new Session('errors');
        $this->member           = new MemberModels();
        $this->franchise        = new FranchiseModels();
        $this->franchiseRequest = new FranchiseRequestModels();
        if($this->userLogin->get('hasLogin') && $this->member->setGet(['active'])->one(['id' => $this->userLogin->get('id')])['active'] == '0'){
            return redirect('login/logout');
        }
    }
    public function index($getData = false){
        if(!$this->userLogin->get('hasLogin') || !$this->userLogin->get('permision')){
            $mess = __('first_please_login');
            return $this->view('login.index', ['message' => $mess, 'type' => 'warning', 'isLogin' => true]);
        }
        if($this->userLogin->get('permision') != '1'){
            $this->errors->set('not_permision', __('not_permision'));
            return redirect('/');
        }
        $franchise = $this->franchise->get(['show_in_create' => 1]);
        $compact = [
            'allowShowBgHeader' => true,
            'franchise' => $franchise ?? [],
            'userLogin' => $this->userLogin->all()
        ];
        if($getData){
            return $this->render('admin.index', $compact);
        }
        return $this->view('admin.index', $compact);
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
                $html = $this->call('Admin@index');
                break;
            case 'upgrade_request' :
                $html = $this->call('UpgradeRequest@getRequest');
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
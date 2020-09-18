<?php

class LoginController extends Controller{

    public $userLogin;
    private $member;
    private $franchise;

    public function __construct(){
        parent::__construct();
        $this->userLogin = new Session('logined');
        $this->member = new MemberModels();
        $this->franchise = new FranchiseModels();
    }
    public function index(){
        if($this->userLogin->get('hasLogin')){
            return redirect('/');
        }
        return $this->view('login.index', ['isLogin' => true]);
    }
    public function check_login(){
        if(!$this->isAjax()){
            return response([
                'code' => 403,
                'message' => __('permision_diened')
            ]);
        }
        $params     = $this->post('params');
        $username   = $params['username'] ?? '';
        $password   = $params['password'] ?? '';
        $remember   = $params['remember'] ?? '';

        if($username == '' || $password == ''){
            return response([
                'code' => 205,
                'message' => __('username_or_password_empty')
            ]);
        }

        $password = $this->hash_password($password);

        $getUser = $this->member->one(['username' => $username, 'password' => $password]);

        if(!$getUser){
            return response([
                'code' => 205,
                'message' => __('username_or_password_not_correct')
            ]);
        }

        if($getUser['active'] != '1'){
            return response([
                'code' => 310,
                'message' => "User is pending admin approve!"
            ]);
        }

        $time = time();
        $token = $this->hash_password($username . $time);
        $token = sha1($token);

        $countLogin = (int)$getUser['count_login'];

        if($countLogin != 0){
            $countLogin = $countLogin + 1;
        }elseif($countLogin >= 1000000){
            $countLogin = 1;
        }

        $aryUpdateUser = [
            'token' => $token,
            'time_create_token' => $time,
            'count_login' => $countLogin
        ];

        if(!$this->member->update($aryUpdateUser, ['id' => $getUser['id']])){
            return response([
                'code' => 204,
                'message' => __('update_member_error')
            ]);
        }

        $franchise = $this->franchise->one(['id' => $getUser['franchise']]);
        $aryUserLogin = [
            'username'          => $username,
            'token'             => $token,
            'id'                => $getUser['id'],
            'permision'         => $getUser['permision'],
            'count_login'       => $countLogin,
            'franchise'         => $franchise['name'] ?? $getUser['franchise'],
            'franchise_type'    => $franchise['type'] ?? $getUser['franchise'],
            'franchise_date'    => $getUser['franchise_date'],
            'license'           => $getUser['license'],
            'license_remaining' => $getUser['license_remaining'],
            'hasLogin'          => true
        ];

        $this->userLogin->setByArray($aryUserLogin);

        if($getUser['permision'] == 1){
            $url = BASE_URL . '/admin';
        }else{
            $url = BASE_URL;
        }

        $aryResponse = [
            'code' => 200,
            'message' => __('login_success'),
            'token' => '',
            'url' => $url
        ];
        if($remember){
            $aryResponse['token'] = $token;
        }

        return response($aryResponse);
    }

    public function remember(){
        if(!$this->isAjax()){
            return response([
                'code' => 403,
                'message' => __('permision_diened')
            ]);
        }
        $token = $this->post('params')['token'] ?? null;
        if($token == null || $token == ''){
            return response([
                'status' => '-1'
            ]);
        }

        $infoToken = $this->member->one(['token' => $token]);
        if(!$infoToken){
            return response([
                'status' => '-2'
            ]);
        }
        $timeLive = config('app', 'time_token_live');
        $timeNow  = time();
        $timeCreate = (int)$infoToken['time_create_token'];
        $checkTimeToken = ($timeNow - $timeCreate) / (60 * 60 * 24);

        if($checkTimeToken >= $timeLive){
            $this->member->update(
                ['token' => '', 'time_create_token' => 0],
                ['id' => $infoToken['id']]
            );
            return response([
                'status' => '-3'
            ]);
        }

        if($infoToken['permision'] == 1){
            $url = BASE_URL . '/admin';
        }else{
            $url = BASE_URL;
        }

        $countLogin = (int)$infoToken['count_login'];

        if($countLogin != 0){
            $countLogin = $countLogin + 1;
        }elseif($countLogin >= 1000000){
            $countLogin = 1;
        }

        $aryUpdateUser = [
            'count_login' => $countLogin
        ];

        if(!$this->member->update($aryUpdateUser, ['id' => $infoToken['id']])){
            return response([
                'code' => 204,
                'message' => __('update_member_error')
            ]);
        }

        $aryUserLogin = [
            'username' => $infoToken['username'],
            'token' => $token,
            'permision' => $infoToken['permision'],
            'count_login' => $countLogin,
            'franchise' => $infoToken['franchise'],
            'hasLogin' => true
        ];

        $this->userLogin->setByArray($aryUserLogin);
        return response([
            'status' => '1',
            'url' => $url
        ]);
    }
    public function logout(){
        $this->userLogin->die();
        return $this->view('login.logout', ['isLogin' => true]);
    }
}